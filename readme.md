## Recruitment Song App Tests

<h2>Video Search</h2>

<p>Little front end to test the connewction and search to Youtube Api</p>
<p>host/videos </p>
<p>host: your host domain name</span></p>


<h2>Api</h2>

<h4>Auth</h4>

<p>hash_hmac(sha256,Parameters,Key)</p>
<p>Parameters:
    <span>Parameters that you send to the request (seacrh,quantity)</span>
</p>
<p>Key: 
    <span>you set the key on the .env file the name of the attribute is EVP_PASS_KEY</span>
</p>
<p>Example:
hash_hmac(sha256,'search,quantity',er4ew5r454)
</p>
<p>hash_hmac('sha256',$search.$quantity,env('EVP_PASS_KEY'));</p>


<table>
    <thead>
        <tr>
            <th>Route</th>
            <th>Method</th>
            <th>Parameters</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>api/v1song/search</td>
            <td>Post</td>
            <td>
                <p>search: <span>type= string</span></p>
                <p>quantity: <span>int </span></p>
            </td>
        </tr>
    </tbody>
</table>
