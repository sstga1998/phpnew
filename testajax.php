<?php 
//sleep(5);
//include_once('model/user.php');
include_once('book.php');
$userName= $_REQUEST["username"];
//echo "<h3 style='color:red'>Xin chào $userName. Tôi là ajax đây hihi!!!!</h3>";
//$user = new User($userName, "12345", "Hiếu Giang");
//$jsonUser = json_encode($user);
//echo $jsonUser;
$lsFromFile = Book::getListFromFile();
?>
<div class="container pt-5">
	<button class="btn btn-outline-info float-right" data-toggle="modal" data-target="#addItem"><i class="fas fa-plus-circle"></i> Thêm</button>
	<form action="" method="GET">
		<div class="form-group">
			<input class="form-control" name="search" style="max-width: 200px; display:inline-block;" placeholder="Search">
			<button type="submit" class="btn btn-default" style="margin-left:-50px"><i class="fas fa-search"></i></button>
		</div>
	</form>
	<table class="table">
		<thead class="thead-dark">
			<tr>
				<th scope="col">STT</th>
				<th scope="col">Tên</th>
				<th scope="col">Giá</th>
				<th scope="col">Tác giả</th>
				<th scope="col">Năm</th>
				<th scope="col">Thao tác</th>
			</tr>
		</thead>
		<tbody>
			<?php
			for ($i = 0; $i < count($lsFromFile); $i++) { ?>
				<tr>
					<th scope="row"><?php echo $lsFromFile[$i]->id ?></th>
					<td><?php echo $lsFromFile[$i]->title ?></td>
					<td><?php echo $lsFromFile[$i]->price ?></td>
					<td><?php echo $lsFromFile[$i]->author ?></td>
					<td><?php echo $lsFromFile[$i]->year ?></td>
					<td class="d-flex">
						<button class="btn btn-outline-info mr-3" data-toggle="modal" data-target="#editItem<?php echo $i ?>"><i class="far fa-edit"></i> Sửa</button>
						<button class="btn btn-outline-danger" name="delete" data-toggle="modal" data-target="#deleteItem<?php echo $i ?>"><i class="fas fa-trash-alt"></i> Xóa</button>
						<!--Edit-->
						<form action="" method="GET">
							<div class="modal fade" id="editItem<?php echo $i ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLongTitle">Edit</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form>
												<div class="form-group ">
													<label for="from">Tên</label>
													<input type="text" name="title" class="form-control" value="<?php echo $lsFromFile[$i]->title ?>" placeholder="Tên">
												</div>
												<div class="form-group">
													<label for="to">Giá</label>
													<input type="number" name="price" class="form-control" value="<?php echo $lsFromFile[$i]->price ?>" placeholder="Giá">
												</div>
												<div class="form-group">
													<label for="class">Tác giả</label>
													<input type="text" name="author" class="form-control" value="<?php echo $lsFromFile[$i]->author ?>" placeholder="Tác giả">
												</div>
												<div class="form-group">
													<label for="place">Năm</label>
													<input type="text" name="year" class="form-control" value="<?php echo $lsFromFile[$i]->year ?>" placeholder="Năm">
												</div>
												<div class="modal-footer">
												<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
													<button class="btn btn-primary" name="edit" type="submit" value="<?php echo $lsFromFile[$i]->id ?>">Save changes</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</form>
						<!--end Edit-->

						<!--Delete-->
						<form action="" method="DELETE">
							<div class="modal fade" id="deleteItem<?php echo $i ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Notice</h5>
											<button class="close" type="button" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">×</span>
											</button>
										</div>
										<div class="modal-body">Do you want to delete this?</div>
										<div class="modal-footer">
											<button class="btn btn-danger" name="del" type="submit" value="<?php echo $lsFromFile[$i]->id ?>">Delete</button>
											<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
										</div>
									</div>
								</div>
							</div>
						</form>
						<!--end Delete-->
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>

<!--Add-->
<div class="modal fade" id="addItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Add book</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post">
					<div class="form-group ">
						<label for="from">Tên</label>
						<input type="text" class="form-control" name="title" placeholder="Tên">
					</div>
					<div class="form-group">
						<label for="to">Giá</label>
						<input type="number" class="form-control" name="price" placeholder="Giá">
					</div>
					<div class="form-group">
						<label for="class">Tác giả</label>
						<input type="text" class="form-control" name="author" placeholder="Tác giả">
					</div>
					<div class="form-group">
						<label for="place">Năm</label>
						<input type="number" class="form-control" name="year" placeholder="Năm">
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary" name="add">Save changes</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!--End Add-->

