# SoulMate-Online-Dating-Platform

## <img src="https://media.giphy.com/media/ObNTw8Uzwy6KQ/giphy.gif" width="30px">&nbsp;Contributors names

✔ ***Saif Farooqui***<br>
✔ ***Kashyap Shirodkar***<br>

<img src="public/assets/SoulMate (3).png" alt="logo" width="300" />

# Why search for a date when you can find your SoulMate?

Signup for free and try your luck. You just might find the girl you've always been waiting for!

<br />

# Preview

![Homepage image](https://s8.gifyu.com/images/homepage.gif)

## Installation
### Step 1: 
Follow this [link](https://www.c-sharpcorner.com/article/how-to-install-wamp-server-in-windows-10/) to download and setup WAMP server on your system

<img src="https://www.fredericgilles.net/wp-content/uploads/2018/01/WampServer-logo.png" alt="logo" width="150" />

Make sure you have the WAMP server up and running 

### Step 2:
Follow [these](https://www.myonlineedu.com/blog/view/5/configure-sendmail-for-wamp-and-connect-with-gmail-in-development) steps to download and configure Fake Sendmail

### Step 3: 
Clone this repo in the following directory: `"C:\wamp64\www\"`

### Step 4: 
Right click on the WAMP Server tray icon and under the tools section, note down the port used by MySQL and Apache server

![mysql port](https://user-images.githubusercontent.com/106474125/175659026-23919992-123d-45bd-9621-e9a66e379224.jpg) ![apache port](https://user-images.githubusercontent.com/106474125/175659033-03b2f865-0efa-4062-8d1f-c6b49b4a69f3.jpg)

In my case it is 3306 and 8081


### Step 5:
Open the SoulMate folder in any code editor of your choice

Open `connection.php` file and replace the port number with the MySQL port number noted in Step 3

![change port number](https://user-images.githubusercontent.com/106474125/175659091-5b40385b-74ff-4e33-955b-31bba9e532c0.jpg)


### Step 6:
Click on the tray icon > MySQL > Open the MySQL console

![image](https://user-images.githubusercontent.com/106474125/175659326-7e3d3968-bb2d-4045-9e70-6676c7ce153c.png)

Continue with the default username `root` and press Enter key as the password

Inside the console, copy paste the following query to create the soulmate database: `CREATE DATABASE soulmate;`


### Step 7:
Open the following link in your browser: `http://localhost:your_apache_port_from_step_3/phpmyadmin/db_export.php?db=soulmate`

Enter `root` as your username, keep the password empty

Go to import tab > Choose file > Select `soulmate.sql` located in `C:\wamp64\www\SoulMate\database\soulmate.sql` and click on Go

![image](https://user-images.githubusercontent.com/106474125/175659407-eb1fb1f7-2caa-4a21-a38d-4666a05c7397.png)

If 8 tables are successfully created in the database, the installation phase is almost complete

### Step 8:
Open the signup page `http://localhost:your_apache_port_from_step_3/dating-website/signup-user.php` 

Register a new account and enter OTP 🔢 received on your email id

![Signup image](https://s8.gifyu.com/images/signup.gif)

Fill in your account details 👨‍💻👩‍💻

![Account details image](https://s8.gifyu.com/images/account.gif)

See your matches. Like ❤ them and wait till they like you back.

![Homepage image](https://s8.gifyu.com/images/homepage.gif)

The one you've liked will see your profile first. If she likes you back, you've found your SoulMate❤ 

![Match image](https://s8.gifyu.com/images/match.gif)

Congratulations 🎉 It's a match 🎉

See what you share in common and chat 📭 to know each other better.

![Live chat image](https://s8.gifyu.com/images/chat.gif)

Come back again later to find more potential soulmates 🤗

![Login image](https://s8.gifyu.com/images/logincfd4bbbaa3e733b7.gif)



<br>

### Authentication Module <br>
Authentication administers the security of a network by allowing only verified users to access protected resources. The authentication process happens only once while the users account is being created. In this module we take the users email address and test its credibility by sending a validation code to it. We then prompt the user to re-enter this code and verify it. If the code validated successfully, the email address is authenticated and the user’s account is created. The user can then login using their email address and created password.
<br><br>

### Profile module <br>
The user profile contains information of the user that can be displayed to other users on the web application. Some of this information may not be visible to other users a match has been formed between the uses. This module takes information and has been implemented in a three step process. In the first step such the user enters basic information such photo, name, age. In the next step the user can add links to their various others social media accounts, and information on their career or education. In the last step the users can select various topics they are interested in, that can be selected from the given set of options
<br><br>

### Recommendation Module <br>
The recommendation module helps users find potential matches with other users on the platform. While the users sets up their account they are also prompted to allow location access which allows the site to generated recommendations based on the users location. A recommendation can also be generated if a partial match has been found where one user has matched with another user but the other users is still yet to respond. Recommendations can also be generated based on the shared user interests. The module therefore acts as filter on all the users so users with a higher potential fully forming a match appear first. From here the users can either accept or reject the person being recommended.
<br><br>

### Match module <br>
Users can access all the information of all their previous matches. This information can include the dates they matched and the person they matched with and a little overview of both the accounts. It also provides additional information such as the distance between them and the interests that they have in common. From here the user is also given the option to chat with the other user or even block them.
<br><br>

### Chat module <br>
The chat module allows users to interact by sending messages to each other.  The module allows interaction between users only if they there is a match that exists between the two users. A list is displayed that contains all the users last interacted with along with the last sent message. The module also shows the activity status of the users. Active is displayed if they are logged in on the website and inactive if they are not.
<br>
