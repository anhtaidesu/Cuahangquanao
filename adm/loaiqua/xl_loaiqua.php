<?php
	$thongbao="";
	if(isset($_POST['goihamxuly']))
	{
		$lenhxuly=$_POST['goihamxuly'];
		if($lenhxuly=='xoaloaihang')
			$thongbao=xoa_loai_qua();
		else if($lenhxuly=='themloaihang')
			$thongbao=them_loai_qua();
		else if($lenhxuly=='sualoaiqua')
			$thongbao=sua_loai_qua();
	}
// ham xoa loai qua
function xoa_loai_qua()
{
	global $ung;
	if(isset($_POST['maloaiqua']))
		$maloaiqua=$_POST['maloaiqua'];
	//kiem tra xem loai hang co lien quan den 
	$strSQL="SELECT COUNT(*) FROM hang WHERE ma_loai={$maloaiqua}";
	$qua=mysqli_query($ung,$strSQL);
	$row=mysqli_fetch_array($qua);
	
	if($row[0]>0)
		return "Không Thể Xóa Loại Quần Áo Đã Có Sản Phẩm";
	//neu khong co qua lien quan thi co the xoa
	$strSQL="DELETE FROM loai_hang WHERE ma_loai={$maloaiqua}";
	mysqli_query($ung,$strSQL);
	return "Xóa Thành Công Loại Quần Áo";
}
// ham them loai qua
function them_loai_qua()
{
	global $ung;
	if(isset($_POST['tenloaiqua']))
		$tenloaiqua=$_POST['tenloaiqua'];
	//kiem tra loai cay co trung ten voi loai cay da co hay ko
		$strSQL="SELECT COUNT(*) FROM loai_hang WHERE ten_loai ='{$tenloaiqua}'";
		$loaiqua=mysqli_query($ung,$strSQL);
		$row=mysqli_fetch_array($loaiqua);
		if($row[0]>0)
			return "Loại Quần Áo Này Đã Tồn Tại! Bạn Hãy Chon Tên Khác";
	//neu khong trung ten luu vao csdl
		$strSQL="INSERT INTO loai_hang(ten_loai) VALUES('{$tenloaiqua}')";
		mysqli_query($ung,$strSQL);
	return "Thêm Thành Công : {$tenloaiqua} Vào Cơ Sở Dữ Liệu!";
}
// ham sua loai qua
function sua_loai_qua()
{	
	global $ung;
	if(isset($_POST['maloaiqua']))
		$maloaiqua=$_POST['maloaiqua'];
	if(isset($_POST['tenloaiqua']))
		$tenloaiqua=$_POST['tenloaiqua'];
	//kiem tra loai qua co trung ten voi loai qua da co hay ko
		$strSQL="SELECT COUNT(*) FROM loai_hang WHERE ten_loai ='{$tenloaiqua}'";
		$loaiqua=mysqli_query($ung,$strSQL);
		$row=mysqli_fetch_array($loaiqua);
		if($row[0]>0)
			return "Loại Quần Áo Này Đã Tồn Tại! Bạn Hãy Chon Tên Khác";
	//neu khong trung ten luu vao csdl
		
		$strSQL="UPDATE loai_hang SET ten_loai='{$tenloaiqua}' WHERE ma_loai={$maloaiqua}";
		mysqli_query($ung,$strSQL);
		
		return "Sửa Thành Công!";
}
//in thong bao

if($thongbao !="")
{
echo "<div style='width:587px; margin-left:3px; margin-right:3px;'>";
echo "<table width='587' cellpadding='0' cellspacing='0' border='0' style='border:#E9E9E9 1px solid; margin-top:3px;'>";
echo "<tr>";
echo "<td>";

echo "<p class='pp'><center><span style='color:#FF9900;'>{$thongbao}</span>"; 
echo "<br />";
echo "<br />";
?>
<center><a href="#" onclick="adm_chuyentrang('quanlyloaicay')">Bấm Vào Đây Để Về Trang Quản Lý Loại Quần Áo</a></center>
<?php
echo "</p>";
echo "</td>";
echo "</tr>";
echo "</table>";
echo "</div>";
}

?>
