<h1>
Laravel Design patterns
</h1>

<p align="center">
  <a href="https://travis-ci.org/laravel-zero/framework"><img src="https://img.shields.io/travis/laravel-zero/framework/stable.svg" alt="Build Status"></img></a>
  <a href="https://scrutinizer-ci.com/g/laravel-zero/framework"><img src="https://img.shields.io/scrutinizer/g/laravel-zero/framework.svg" alt="Quality Score"></img></a>
  <a href="https://packagist.org/packages/laravel-zero/framework"><img src="https://poser.pugx.org/laravel-zero/framework/d/total.svg" alt="Total Downloads"></a>
  <a href="https://packagist.org/packages/laravel-zero/framework"><img src="https://poser.pugx.org/laravel-zero/framework/v/stable.svg" alt="Latest Stable Version"></a>
  <a href="https://packagist.org/packages/laravel-zero/framework"><img src="https://poser.pugx.org/laravel-zero/framework/license.svg" alt="License"></a>
</p>

<h4> <center>This is a <bold>community project</bold> and not an official Laravel one </center></h4>

Laravel Design Patterns was created by, and is maintained by [Innocent Mazando](https://github.com/innoflash), and is console application running on composer used to create Laravel Repository and Service pattern. 
## Installation

Install via composer.

Note: For windows user, first run `composer global update`

```bash
composer global require innoflash/laravel-design-patterns
```
### Create a repository
```sh
ldp pattern:repository {model_name}
```
The ```model_name``` is the model you wanna create a repository for
eg
```dotenv
ldp pattern:repository Models/User
``` 
links a the ```App\Models\User```
And likewise 
```
ldp pattern:repository User
```
links ```App\User```
Command creates the repo folder under Repositories in the model name folder

![Repo folder](images/repo_folder.PNG)

This creates an ModelEloquent file that you are gonna have to override when you are passing your app login

![Repo Eloquent](images/repo_eloq.PNG)

Also it creates an interface that`s used in the Eloquent file. You can add or remove more abstract methods to this to further customize your repo

![Repo Interface](images/repo_interface.PNG)


### Create a service
```dotenv
ldp pattern:service {model_name}
```
The ```model_name``` is the model you wanna create a repository for
eg
```dotenv
ldp pattern:service Models/User
```
links a the ```App\Models\User```
And likewise 
```
ldp pattern:service User
```
links ```App\User```
Command creates the service file Services with your model name concatenated with "Service"

![Service file](images/service_folder.PNG)

This is how the service class created looks like

![Service stub](images/service_stub.PNG)
