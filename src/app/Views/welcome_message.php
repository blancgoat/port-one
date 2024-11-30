<!DOCTYPE html>
<html>
<head>
    <title>Markdown Style Code in HTML</title>
    <style>
        pre {
            background-color: #f6f8fa;
            padding: 10px;
            border-radius: 5px;
            overflow: auto;
        }
        code {
            font-family: monospace;
            color: #d63384;
        }
    </style>
</head>
<body>
    <a href="http://localhost/project1" target="_blank">Question 1</a>
    <p>Question 2</p>
    <pre><code>
curl --request POST \
  --url http://localhost/project2 \
  --header 'Content-Type: application/json' \
  --data '{"imp_uid": ["imp_912634209078", "imp_155323811522"]}'
    </code></pre>

</body>
</html>