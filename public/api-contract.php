<style>
    body{
        font-family: Arial, sans-serif;
    }

    h1{
        color: #82589F;
        text-align: center;
        margin-bottom: 20px;
    }

    table{
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
        font-size: 15px;
    }

    thead{
        background: #c56cf0; 
        color: white;
    }

    th, td{
        border: 1px solid #a978c9; 
        padding: 10px;
        text-align: left;
    }

    tbody tr:nth-child(even){
        background: #f6e8ff;
    }

    tbody tr:hover{
        background: #e4ccff; 
        transition: 0.3s;
    }

    .styled-text {
        font-weight: bold;
        color: #8e44ad; 
        text-shadow: 0px 0px 1px #d2a3e6;
    }

    .no-style {
        font-weight: normal;
        color: inherit;
        text-shadow: none;
    }

    footer{
        margin-top: 20px;
        text-align: center;
        font-weight: bold;
        color: #cd84f1;
        padding: 10px 0;
        font-size: 14px;
        width: 100%;
    }
</style>


<h1>API Contract</h1>

<table border="0">
    <thead>
        <tr>
            <th>Endpoint</th>
            <th>Method</th>
            <th>Autentikasi</th>
            <th>Params / Body</th>
            <th>Response (200)</th>
        </tr>
    </thead>
    <tbody>
    <tr>
        <td>/api/v1/health</td>
        <td>GET</td>
        <td>-</td>
        <td>-</td>
        <td>{status: "ok"}</td>
    </tr>

    <tr>
        <td>/api/v1/contract</td>
        <td>GET</td>
        <td>-</td>
        <td>-</td>
        <td>{contract}</td>
    </tr>

    <tr>
        <td>/api/v1/auth/login</td>
        <td>POST</td>
        <td>-</td>
        <td>{email, password}</td>
        <td>{token}</td>
    </tr>

    <tr>
        <td>/api/v1/users</td>
        <td>GET</td>
        <td>Bearer</td>
        <td>page, per_page</td>
        <td>Meta{...}, Data{...}</td>
    </tr>

    <tr>
        <td>/api/v1/users/{id}</td>
        <td>GET</td>
        <td>Bearer</td>
        <td>{id}</td>
        <td>{id, name, email, role, ...}</td>
    </tr>

    <tr>
        <td>/api/v1/users</td>
        <td>POST</td>
        <td>Bearer (admin)</td>
        <td>{name, email, password, role}</td>
        <td>Created (201)</td>
    </tr>

    <tr>
        <td>/api/v1/users/{id}</td>
        <td>PUT</td>
        <td>Bearer (admin)</td>
        <td>{name?, email?, password?, role?}</td>
        <td>Updated (200)</td>
    </tr>

    <tr>
        <td>/api/v1/users/{id}</td>
        <td>DELETE</td>
        <td>Bearer (admin)</td>
        <td>{id}</td>
        <td>Deleted (200)</td>
    </tr>

    <tr>
        <td>/api/v1/upload</td>
        <td>POST</td>
        <td>Bearer</td>
        <td>{file}</td>
        <td>{filename, url}</td>
    </tr>

    <tr>
        <td>/api/v1/version</td>
        <td>GET</td>
        <td>-</td>
        <td>-</td>
        <td>{version}</td>
    </tr>
</tbody>
</table>
<footer>
    CREATE by: Cindy 2025.
</footer>
</html>

