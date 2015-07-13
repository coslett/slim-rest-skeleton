#Skeleton Slim Framework

#####Disclaimer:
This is for my own personal use. You are more than welcome to use it as you'd like and comment if you have suggestions but I am not releasing this as a stable Skeleton for others to use.

This is what I've found works for me when building a simple (key word) RESTful API. There are plenty of pieces I am cleaning up such as authentication of the user but again, this is a simple skeleton with the base packages I've found work for what I need. 

#####Information:
I've taken a project I worked on, removed all of the proprietary logic and included everything in a Skeleton namespace. I've done the same for class names. I have left very very very minimal comments as again, this is for my own personal use.

This is the best balance of lightness / support I've found in building an API quickly.

#####Notes:

This is not a standard MVC design (going from Controller directly to the Repository). For more advanced APIs a Model would be ideal for the controller to speak to. Due to the nature of this setup I'm treating the Repository as the Handler as business logic is very minimal.

#####Updates:

I do recommend looking into Silex as an alternative to Slim Framework. I've found that once you are touching OAuth and other packages it's best to start with a Symfony base as the integration is a little easier. Silex and Slim Framework also share many similarities so transitioning is quite easy. 