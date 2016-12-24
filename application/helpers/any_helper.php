<?php
function format_rupiah($angka)
{
	return number_format($angka,0,',','.');
}
function seo_title($s) {
    $c = array (' ');
    $d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+');
    $s = str_replace($d, '', $s); // Hilangkan karakter yang telah disebutkan di array $d

    $s = strtolower(str_replace($c, '-', $s)); // Ganti spasi dengan tanda - dan ubah hurufnya menjadi kecil semua
    return $s;
}
function simple_time($time){
		$new_time = explode(":", $time);
		return $new_time[0].':'.$new_time[1];
}
function tgl_indo($tgl){
		$tanggal = substr($tgl,8,2);
		$bulan = getBulan(substr($tgl,5,2));
		$tahun = substr($tgl,0,4);
		return $tanggal.' '.$bulan.' '.$tahun;
}
function tgl_dmy($tgl)
{
	$explode = explode("-", $tgl);
	return $explode[2].'/'.$explode[1].'/'.$explode[0];
}
function getBulan($bln){
			switch ($bln){
				case 1:
					return "Januari";
					break;
				case 2:
					return "Februari";
					break;
				case 3:
					return "Maret";
					break;
				case 4:
					return "April";
					break;
				case 5:
					return "Mei";
					break;
				case 6:
					return "Juni";
					break;
				case 7:
					return "Juli";
					break;
				case 8:
					return "Agustus";
					break;
				case 9:
					return "September";
					break;
				case 10:
					return "Oktober";
					break;
				case 11:
					return "November";
					break;
				case 12:
					return "Desember";
					break;
			}
		}
function change_day($hari){
			switch ($hari){
				case  "Sunday":
					return "Minggu";
					break;
				case  "Monday":
					return "Senin";
					break;
				case "Tesday":
					return "Selasa";
					break;
				case  "Wednesday":
					return "Rabu";
					break;
				case  "Thursday":
					return "Kamis";
					break;
				case  "Friday":
					return "Jumat";
					break;
				case  "Saturday":
					return "Sabtu";
					break;
				default  :
					return "$hari";
					break;
			}
		}
?>
