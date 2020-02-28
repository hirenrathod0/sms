<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Export Sample</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<script type="text/javascript" src="tableExport.js"></script>
<script type="text/javascript" src="jquery.base64.js"></script>
<script type="text/javascript" src="html2canvas.js"></script>
<script type="text/javascript" src="jspdf/libs/sprintf.js"></script>
<script type="text/javascript" src="jspdf/jspdf.js"></script>
<script type="text/javascript" src="jspdf/libs/base64.js"></script>
<script type="text/javascript">
function export_name()
{
    $('#customers').tableExport({type:'pdf',escape:'false'});
}

$(document).ready(function(e) {
    export_name();
});
</script>
</head>

<body>
<table id="customers" class="table table-striped" >
    <thead>            
        <tr class='warning'>
            <th>Country</th>
            <th>Population</th>
            <th>Date</th>
            <th>%ge</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Chinna</td>
            <td>1,363,480,000</td>
            <td>March 24, 2014</td>
            <td>19.1</td>
        </tr>
        <tr>
            <td>India</td>
            <td>1,241,900,000</td>
            <td>March 24, 2014</td>
            <td>17.4</td>
        </tr>
        <tr>
            <td>United States</td>
            <td>317,746,000</td>
            <td>March 24, 2014</td>
            <td>4.44</td>
        </tr>
        <tr>
            <td>Indonesia</td>
            <td>249,866,000</td>
            <td>July 1, 2013</td>
            <td>3.49</td>
        </tr>
        <tr>
            <td>Brazil</td>
            <td>201,032,714</td>
            <td>July 1, 2013</td>
            <td>2.81</td>
        </tr>
    </tbody>
</table> 
</body>
</html>