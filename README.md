# Parser RSS Feed

## Task Description

Implement an RSS feed parser on Laravel framework (for example, https://lifehacker.com/rss can be selected as an RSS feed)

1. New publications should be saved in a 'posts' database table
2. Create a CRUD for Posts - REST API (or GraphQL API) 
3. Write API documentation (Swagger, etc.)
4. Create a public GitHub (GitLab, etc.) repository, upload the code

---

- To run the parser, you need to run the file `public\index.php`
- The API documentation is available at `/api/documentation`
- There are tables `post`, `categories` and a many-to-many relationship between `post_categories`.
