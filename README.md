# Simple-verification-code-based-on-cookie
基于Cookie的简单验证码（自己的想法，重复造轮子）
## 演示站点
http://demo.f0f.cc/yzcode/
## 验证流程
获取验证码时，同时下发key存在Cookie，key是由验证码加入一些参数，通过特定算法得出的密文，无法逆向得出验证码  
验证是通过用户提交的字符，通过同样的算法算出密文，与Cookie1的key相同，则验证通过，若不相同，则key作废，需重新获取
