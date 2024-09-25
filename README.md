# pcb-dingtalk

pcb-dingtalk 为 pcb 项目封装了钉钉认证、即时消息等服务端 API。

## 安装

```shell
composer require "pcb-org/pcb-dingtalk"
```

## 使用示例

```php
use PcbDingtalk\Application;

$config = [
    'app_id' => 'dingxxxx0vqoc2uyxxxx',
    'app_secret' => 'JWAJwV1_yzcxxxx_-6Z6TXFNzLtsBj0m376WjMOaNNttlKmyu5EiZR1VQE6txxxx',
];

$app = new Application($config);

$app->makeUser()->getUserByPhone($phoneNumber);
```
