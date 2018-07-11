## Recruitment Song App Tests

<h2>Video Search</h2>

<p>Little front end to test the connection and search to Youtube Api</p>
<p>host/videos </p>
<p>host: your host domain name</span></p>


<h2>Api</h2>

<table>
    <thead>
        <tr>
            <th>Route</th>
            <th>Method</th>
            <th colspan="2">Parameters</th>
        </tr>
    </thead>
    <tbody>
    	<tr>
			<td>api/v1/search</td>
			<td>Post</td>
			<td>
				<p>search: <span>type= string</span></p>
			</td>
			<td>
				<p>quantity: <span>int </span></p>
			</td>
        </tr>
        <tr>
            <td>api/v1/search/song</td>
            <td>Post</td>
            <td colspan="2">
                <p>search: <span>type= string</span></p>
            </td>
        </tr>
        <tr>
            <td>api/v1/search/video</td>
            <td>Post</td>
            <td>
                <p>search: <span>type= string</span></p>
            </td>
            <td>
            	<p>quantity: <span>int </span></p>
            </td>
        </tr>
    </tbody>
</table>
