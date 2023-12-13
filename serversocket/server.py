import asyncio
import websockets
import json
import requests
clients={}
httpurl="http://127.0.0.1:8000/apiports/";
groupusers=json.loads(requests.get(httpurl+"zchat/server/groupuserlist.php").text)
#print(groupusers)
async def main(nowcli):
    global groupusers
    init_data = await nowcli.recv()
    userinfo=json.loads(init_data)
    #print(userinfo)
    acc=requests.get(httpurl+"zchat/user/join.php?json="+init_data).text
    groupusers=json.loads(requests.get(httpurl+"zchat/server/groupuserlist.php").text)
    if acc !="OK":
        await nowcli.close()
        return
    print (userinfo['id'],clients)
    clients[userinfo['id']]=nowcli
    try:
        while True:
            message = await nowcli.recv()
            print("Received message:", message)
            if(message=='reloadusers'):
                groupusers=json.loads(requests.get(httpurl+"zchat/server/groupuserlist.php").text)
                continue
            minfo=json.loads(message)
            cordmes=json.loads(requests.get(httpurl+"zchat/msg/recordmsg.php?mes="+message).text)
            if cordmes['onerror']==1:
                await nowcli.close()
                return
            tongbuinfo={"mes":cordmes["msg"],"group":minfo['group'],"order":"onmes"}
            minfo["group"]=str(minfo['group'])
            if not (minfo['group'] in groupusers):
                #print(groupusers,minfo['group'])
                err={"order":"error","code":"G404"}
                await nowcli.send(json.dumps(err))
                continue
            print (groupusers[minfo['group']])
            for user in groupusers[minfo['group']]:
                user=str(user)
                #print ("will send To "+user)
                if(user in clients):
                    ns=clients[user]
                    await ns.send(json.dumps(tongbuinfo))

    except websockets.exceptions.ConnectionClosedOK:
        print("Connection closed",nowcli)
        del clients[userinfo['id']]

async def start_server():
    server = await websockets.serve(
        main,
        "localhost", 8001)  # replace with your desired host and port
    await server.wait_closed()

if __name__ == "__main__":
    asyncio.run(start_server())