<?php
	include("config.inc.php");
	session_start();
	if(!isset($_SESSION['username']))
	{
		header('Location:../index.php');
	}


	$username = $_SESSION['username'];

	// initialization
	$result_final = "";
	$counter = 0;

	// List of our known photo types
	$known_photo_types = array( 
						'image/pjpeg' => 'jpg',
						'image/jpeg' => 'jpg',
						'image/gif' => 'gif',
						'image/bmp' => 'bmp',
						'image/x-png' => 'png'
					);
	
	// GD Function List
	$gd_function_suffix = array( 
						'image/pjpeg' => 'JPEG',
						'image/jpeg' => 'JPEG',
						'image/gif' => 'GIF',
						'image/bmp' => 'WBMP',
						'image/x-png' => 'PNG'
					);

	// Fetch the photo array sent by preupload.php
	$photos_uploaded = $_FILES['photo_filename'];

	// Fetch the photo caption array
	$photo_caption = $_POST['photo_caption'];

	$category_name = $_POST['category'];

	while( $counter <= count($photos_uploaded) )
	{
		if($photos_uploaded['size'][$counter] > 0)
		{
			if(!array_key_exists($photos_uploaded['type'][$counter], $known_photo_types))
			{
				$result_final .= "File ".($counter+1)." is not a photo<br />";
			}
			else
			{
				$query = "select  category_id from gallery_category where username = '".$username."' and category_name = '".$category_name."'";
				$result = mysql_query($query);
				echo $username;
				echo $category_name;
				while($row = mysql_fetch_array( $result ))
				{
					$photo_category = $row[0];
					print($photo_category);
				}

				mysql_query( "INSERT INTO gallery_photos(`photo_filename`, `photo_caption`, `photo_category`) VALUES('0', '".addslashes($photo_caption[$counter])."', '".addslashes($photo_category)."')" );
				$new_id = mysql_insert_id();
				$filetype = $photos_uploaded['type'][$counter];
				$extention = $known_photo_types[$filetype];
				$filename = $new_id.".".$extention;

				mysql_query( "UPDATE gallery_photos SET photo_filename='".addslashes($filename)."' WHERE photo_id='".addslashes($new_id)."'" );

				// Store the orignal file
				copy($photos_uploaded['tmp_name'][$counter], $images_dir."/".$filename);

				// Let's get the Thumbnail size
				$size = GetImageSize( $images_dir."/".$filename );
				if($size[0] > $size[1])
				{
					$thumbnail_width = 500;
					$thumbnail_height = (int)(500 * $size[1] / $size[0]);
				}
				else
				{
					$thumbnail_width = (int)(500 * $size[0] / $size[1]);
					$thumbnail_height = 500;
				}
			
				// Build Thumbnail with GD 1.x.x, you can use the other described methods too
				$function_suffix = $gd_function_suffix[$filetype];
				$function_to_read = "ImageCreateFrom".$function_suffix;
				$function_to_write = "Image".$function_suffix;

				// Read the source file
				$source_handle = $function_to_read ( $images_dir."/".$filename ); 
				
				if($source_handle)
				{
					// Let's create an blank image for the thumbnail
				     	$destination_handle = ImageCreate ( $thumbnail_width, $thumbnail_height );
				
					// Now we resize it
			      	ImageCopyResized( $destination_handle, $source_handle, 0, 0, 0, 0, $thumbnail_width, $thumbnail_height, $size[0], $size[1] );
				}

				// Let's save the thumbnail
				$function_to_write( $destination_handle, $images_dir."/tb_".$filename );
				ImageDestroy($destination_handle );
				//

				$result_final .= "<img src='".$images_dir. "/tb_".$filename."' /> File ".($counter+1)." Added<br />";
			}
		}
	$counter++;
	}

	header('Location:index.php?category='.$category_name);


?>
