<?php
if($query->isAdmin() && isset($_GET['id'])){
	if($query->delete($table,$id)){
		addSession('success','One Business Deleted Successfully');
	}else{
		addSession('failure','OOPs! Something went wrong');
	}
	redirect("/admin");

}
else{
	addSession('failure','You didnt select any business');
}
?>