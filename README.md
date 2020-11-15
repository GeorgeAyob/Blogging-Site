# Blogging-Site
Blogging site that allows users to create accounts, search for books and discuss them with one another.

<img width="1280" alt="Screen Shot 2020-11-15 at 1 26 03 PM" src="https://user-images.githubusercontent.com/51719874/99193316-32e51500-2746-11eb-86ba-94bf237618ad.png">

Features of the website:

- login/register/logout
- home page lets you read all the blogs that are in the database
- blogs page lets you read only your blogs
- update/delete button lets you update any of your blogs
- create button lets you create a new blog, user can type the new blog or upload a txt file

Database had two tables:
- user: had userID (primary key), name, email, hashed password
- post: had postID (primary key), userID (foreign key), title, content, date
