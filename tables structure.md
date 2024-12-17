Normal users table
    userid, name, email, password, rolebyid;

roles:
    id, role_name

tags:
    articleid, frontend, backend;

comments:
    comment_id, article_id, user_id, commentername,  createdat, content;

tags:

articles table:
    articleid, userid, tagid, title, content, date;
