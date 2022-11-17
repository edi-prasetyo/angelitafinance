<html>
<head>
<title>Search</title>
</head>
<body>
<form action="<?php echo base_url('admin/testing/search');?>" method="get">
<div class="col-md-8 pl-0 pr-0">
<input type="text" name="class" class="form-control textbox1" placeholder="Class name" required="" value="<?php echo $this->input->get('class');?>" />
</div>
<div class="col-md-4 pl-0 pr-0">
<button type="submit" class="btn btn-primary">Search Students</button>
</div>
</form>

<?php
if($res->num_rows()>0)
{
echo '<table class="table table-bordered"><tr><th>Name</th><th>Roll No.</th><th>Class</th></tr>';
foreach($res->result() as $search_result)
{
echo '<tr>'.$search_result->user_name.'<td></td><td>'.$search_result->user_phone.'</td><td>'.$search_result->user_address.'</td></tr>';
}
echo '<table>';
}

echo $pagination;
?>
</body>
</html>
