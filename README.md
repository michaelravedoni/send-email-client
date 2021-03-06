<h1 align="center">send-email-client-client</h1> <br>
<div align="center">
  <strong>Send email directly from the client-side</strong>
</div>
<div align="center">
  Send simple email with mailjet from the client side without server.
</div>

<div align="center">
  <h3>
    <a href="#">Documentation</a>
    <span> | </span>
    <a href="#contributing">
      Contributing
    </a>
  </h3>
</div>

<div align="center">
  <sub>Built with ❤︎ by
  <a href="https://michael.ravedoni.com/en">Michael Ravedoni</a> and
  <a href="https://github.com/michaelravedoni/send-email-client/contributors">
    contributors
  </a>
</div>

## Table of Contents

- [Introduction](#introduction)
- [Features](#features)
- [Install](#install)
- [Usage](#usage)
- [Contributing](#contributing)
- [Authors and acknowledgment](#authors-and-acknowledgment)

## Introduction
[![license](https://img.shields.io/github/license/michaelravedoni/send-email-client.svg?style=flat-square)](https://github.com/michaelravedoni/send-email-client/blob/master/LICENSE)

Send simple email with through POST HTTP requests on the client side. This is a PHP service that takes the basic elements required to send an email with `mailjet` or SMTP (soon…) with Laravel. The key / values are taken from `variables` parameter and replaced through the template selected by the `template` or `template_id` variable.

## Features

- Send email with a POST HTTP request
- Email `.html` templating with `{{...}}` Blade moustaches (soon…)

## Install

Download and unzip the repository content to your host or service. E.g. : `example.com/services/send-email-client`. Or Download the source code with Git :

```
git clone https://github.com/michaelravedoni/send-email-client.git
```

By default the project comes with a `.env.example` file. You'll need to rename this file to just .env regardless of what environment you're working on. It's now just a case of editing this new `.env` file and setting the values of your setup.

> :information_source: Any values with spaces in them should be contained within double quotes.

We use [Composer](https://getcomposer.org/) to manage its dependencies and extensions. You will need to install [Composer](https://getcomposer.org/) on your machine. Afterwards, run this command in the repository where you have dowloaded the project in:

```
cd send-email-client
composer install
```

Before going any further, we need to set the APP_KEY config. This is used for all encryption used in Cachet.

```
php artisan key:generate
```
> :warning: Never change the `APP_KEY` after installation on production environment. This will result in all of your encrypted/hashed data being lost.

## Usage
HTTP Post parameters :

| Name  | Type | Description | Example |
|---|---|---|---|
| to_email | string | Receiver email. Required. | `to@example.com` |
| to_name | string | Receiver name. Required. | `Jack` |
| from_email  | string | Email sender. Required. | `from@example.com` |
| from_name  | string | Email sender name | `John` |
| subject | string | Email subject. Required. | `Example subject` |
| template_id | int | Template id for *mailjet*.  | `123456` |
| message_text | string | You can write your own message if you don't want to use a template | `Hi, this is my message` |
| message_html | string | You can write your own message if you don't want to use a template | `Hi, this is my <u>message</u>` |
| variables |  Object (JSON) | The key/values are taken from data and replaced through the template. | `{"name": "John Doe", "message": "Un petit message"}`

### As HTTP service

#### Curl
```curl
curl --request POST \
  --url https://example.com/services/send-email-client/ \
  --header 'content-type: multipart/form-data;' \
  --form 'to=<EMAIL_TO>' \
  --form 'from=<EMAIL_FROM>' \
  --form 'template=<FILE_OR_URL>' \
  --form data=<JSON_DATA> \
  --form subject=<SUBJECT>
```

#### JavaScript (XMLHttpRequest)
```javascript

const data = JSON.stringify({
  "subject": "Example subject",
  /* … */
});

const xhr = new XMLHttpRequest();
xhr.withCredentials = true;
xhr.open("POST", "https://example.com/api/sendmail");
xhr.setRequestHeader("Content-Type", "application/json");
xhr.send(data);
```

#### JavaScript (fetch)
```javascript
fetch("https://example.com/api/sendmail", {
  "method": "POST",
  "headers": {
    "Content-Type": "application/json"
  },
  "body": {
	"subject": "Example subject",
    /* … */
  }
})
.then(response => {
  console.log(response);
})
.catch(err => {
  console.error(err);
});
```

#### JavaScript (axios)
```javascript
import axios from "axios";

const options = {
  method: 'POST',
  url: 'https://example.com/api/sendmail',
  headers: {'Content-Type': 'application/json'},
  data: {
    subject: 'Example subject',
    /* … */
  }
};

axios.request(options).then(function (response) {
  console.log(response.data);
}).catch(function (error) {
  console.error(error);
});
```

#### Node.js (request)
```javascript
const request = require('request');

const options = {
  method: 'POST',
  url: 'https://example.com/api/sendmail',
  headers: {'Content-Type': 'application/json'},
  body: {
    subject: 'Example subject',
    /* … */
  json: true
};

request(options, function (error, response, body) {
  if (error) throw new Error(error);
  console.log(body);
});
```

## Contributing

We’re really happy to accept contributions from the community, that’s the main reason why we open-sourced it! There are many ways to contribute, even if you’re not a technical person.

1. Fork it (<https://github.com/michaelravedoni/send-email-client/fork>)
2. Create your feature branch (`git checkout -b feature/fooBar`)
3. Commit your changes (`git commit -am 'Add some fooBar'`)
4. Push to the branch (`git push origin feature/fooBar`)
5. Create a new Pull Request

## Roadmap

- Templating with blade
- Send via SMTP

## Authors and acknowledgment

* **Michael Ravedoni** - *Initial work* - [michaelravedoni](https://github.com/michaelravedoni)

See also the list of [contributors](https://github.com/michaelravedoni/send-email-client/contributors) who participated in this project.

## License

[MIT License](https://opensource.org/licenses/MIT)
