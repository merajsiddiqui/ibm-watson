## IBM Watson PHP SDK

[IBM Watson](https://github.com/merajsiddiqui/ibm-watson/edit/master/README.md) is PHP SDK of using IBM watson services provided by IBM. This sdk is unofficial. I personally wish to develop this and i will maintain is as long as possible.

You are free to fork this, use it, and create and issue, I also request you to  fork , contribute and create a pull request [Jekyll](https://jekyllrb.com/) to rebuild the pages in your site, from the content in your Markdown files.

### Installation

It is advised to install it using composer.

```markdown

`composer require merajsiddiqui/ibm-watson`

```

### Signup IBM watson  and get credentials to use API

/config/conversation.json

```markdown
{
  "url": "https://gateway.watsonplatform.net/conversation/api",
  "username": "some random string password provided",
  "password": "randompassword"
}
```
Authenticating to Service

```markdown
<?php

include dirname(__DIR__). "/vendor/autoload.php";

//Provide jspn file to config

use IBMWatson\Config;

//json file containing url, username and password for the service

$api_credintial_json_file = "/config/conversation.json";
$config = Config::init($api_credintial_json_file);

```

For more details see [GitHub Flavored Markdown](https://guides.github.com/features/mastering-markdown/).


### Support or Contact

Having any trouble mail me at : merajsiddiqui@outlook.com or create an issue. Always use IBM watson API refrence for using this sdk.
