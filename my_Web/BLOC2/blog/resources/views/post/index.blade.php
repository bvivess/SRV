<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Dashboard</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
		<style>
			.wrapper{
				width: 600px;
				margin: 0 auto;
			}
			table tr td:last-child{
				width: 120px;
			}
		</style>
		<script>
			$(document).ready(function(){
				$('[data-toggle="tooltip"]').tooltip();   
			});
		</script>
	</head>
    <body>
        <div class="wrapper">
        <div class="row">
        <div class="col-md-12">
            <div class="mt-5 mb-3 clearfix">
				<h2 class="pull-left">Post Details</h2>
				<a href="create.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New Post</a>
			</div>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Posted</th>
                        <th>Created</th>
                        <th>Modified</th>
                        <th>Action</th>
                    </tr>
                </thead>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->posted }}</td>
                        
                        <td>{{ $post->created_at }}</td>
                        <td>{{ $post->updated_at }}</td>
                        <td>
                            <form action="{{route('post.edit', $post->id)}}" method="POST" >
                                @method('GET')
                                @csrf
                                <button type="submit" >Edit</button>
                            </form>
                        </td>
                        <td>
                            <form action="{{route('post.destroy', $post->id)}}" method="POST" >
                                @method('DELETE')
                                @csrf
                                <button type="submit" >Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        </div>
        </div>
        </div>
    </body>
</html>