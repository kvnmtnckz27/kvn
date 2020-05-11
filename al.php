<?php
date_default_timezone_set('Asia/Makassar');
include "functi.php";
echo color("red","     ===========================\n");
echo color("red","| Claim Voucher Gojek                |\n");
echo color("red","| Auto create Gojek X Redeem voucher |\n");
echo color("blue","| Facebook : Kevin Mitnickz          |\n");
echo color("blue","| Creator  : kvnMtnckz               |\n");
echo color("green","| Time     : ".date('[d-m-Y] [H:i:s]')." |\n");
echo color("green","     ===========================\n");
function change(){
        $nama = nama();
        $email = str_replace(" ", "", $nama) . mt_rand(100, 99999);
        ulang:
        echo color("nevy","?] Nomor   : ");
        // $no = trim(fgets(STDIN));
        $nohp = trim(fgets(STDIN));
        $nohp = str_replace("62","62",$nohp);
        $nohp = str_replace("(","",$nohp);
        $nohp = str_replace(")","",$nohp);
        $nohp = str_replace("-","",$nohp);
        $nohp = str_replace(" ","",$nohp);

        if (!preg_match('/[^+0-9]/', trim($nohp))) {
            if (substr(trim($nohp),0,3)=='62') {
                $hp = trim($nohp);
            }
            else if (substr(trim($nohp),0,1)=='0') {
                $hp = '62'.substr(trim($nohp),1);
        }
         elseif(substr(trim($nohp), 0, 2)=='62'){
            $hp = '6'.substr(trim($nohp), 1);
        }
        else{
            $hp = '1'.substr(trim($nohp),0,13);
        }
    }
        $data = '{"email":"'.$email.'@gmail.com","name":"'.$nama.'","phone":"+'.$hp.'","signed_up_country":"ID"}';
        $register = request("/v5/customers", null, $data);
        if(strpos($register, '"otp_token"')){
        $otptoken = getStr('"otp_token":"','"',$register);
        echo color("green","+] Kode verifikasi sudah di kirim")."\n";
        otp:
        echo color("nevy","?] Otp: ");
        $otp = trim(fgets(STDIN));
        $data1 = '{"client_name":"gojek:cons:android","data":{"otp":"' . $otp . '","otp_token":"' . $otptoken . '"},"client_secret":"83415d06-ec4e-11e6-a41b-6c40088ab51e"}';
        $verif = request("/v5/customers/phone/verify", null, $data1);
        if(strpos($verif, '"access_token"')){
        echo color("green","+] Berhasil mendaftar\n");
        $token = getStr('"access_token":"','"',$verif);
        $uuid = getStr('"resource_owner_id":',',',$verif);
        echo color("green","+] Your access token : ".$token."\n\n");
        save("token.txt",$token);
        #echo "\n".color("nevy","?] Mau Redeem Voucher?: y/n ");
        $pilihan = trim(fgets(STDIN));
        if($pilihan == "y" || $pilihan == "Y"){
        echo color("red","===========(REDEEM VOUCHER)===========");
        echo "\n".color("yellow","!] GOFOOD 15+10+5");
        echo "\n".color("yellow","!] Dagoan weh");
        for($a=1;$a<=3;$a++){
        echo color("yellow",".");
        sleep(30);
        }
        $code1 = request('/go-promotions/v1/promotions/enrollments', $token, '{"promo_code":"COBAGOFOOD160420A"}');
        $message = fetch_value($code1,'"message":"','"');
        if(strpos($code1, 'Promo kamu sudah bisa dipakai')){
        echo "\n".color("green","+] Message: ".$message);
        goto gofood;
        }else{
        echo "\n".color("red","-] Message: ".$message);
        gofood:
        echo "\n".color("yellow","!] Sakedap");
        echo "\n".color("yellow","!] Dagoan weh");
        for($a=1;$a<=3;$a++){
        echo color("yellow",".");
        sleep(1);
        }
        $code1 = request('/go-promotions/v1/promotions/enrollments', $token, '{"promo_code":"COBAGOFOOD160420BB"}');
        $message = fetch_value($code1,'"message":"','"');
        if(strpos($code1, 'Promo kamu sudah bisa dipakai')){
        echo "\n".color("green","+] Message: ".$message);
        goto setpin;
        }else{
        echo "\n".color("red","-] Message: ".$message);
        gocar:
        echo "\n".color("yellow","!] GOFOOD 10+10");
        echo "\n".color("yellow","!] Dagoan weh");
        for($a=1;$a<=3;$a++){
        echo color("yellow",".");
        sleep(10);
        }
        $code1 = request('/go-promotions/v1/promotions/enrollments', $token, '{"promo_code":"COBAGOFOOD160420B"}');
        $message = fetch_value($code1,'"message":"','"');
        if(strpos($code1, 'Promo kamu sudah bisa dipakai')){
        echo "\n".color("green","+] Message: ".$message);
        sleep(1);
        $cekvoucher = request('/gopoints/v3/wallet/vouchers?limit=10&page=1', $token);
        $total = fetch_value($cekvoucher,'"total_vouchers":',',');
        $voucher3 = getStr1('"title":"','",',$cekvoucher,"3");
        $voucher1 = getStr1('"title":"','",',$cekvoucher,"1");
        $voucher2 = getStr1('"title":"','",',$cekvoucher,"2");
        $voucher4 = getStr1('"title":"','",',$cekvoucher,"4");
        $voucher5 = getStr1('"title":"','",',$cekvoucher,"5");
        $voucher6 = getStr1('"title":"','",',$cekvoucher,"6");
        echo "\n".color("yellow","!] Total voucher ".$total." : ");
        echo color("green","1. ".$voucher1);
        echo "\n".color("green","                     2. ".$voucher2);
        echo "\n".color("green","                     3. ".$voucher3);
        echo "\n".color("green","                     4. ".$voucher4);
        echo "\n".color("green","                     5. ".$voucher5);
        echo "\n".color("green","                     6. ".$voucher6);
        $expired1 = getStr1('"expiry_date":"','"',$cekvoucher,'1');
        $expired2 = getStr1('"expiry_date":"','"',$cekvoucher,'2');
        $expired3 = getStr1('"expiry_date":"','"',$cekvoucher,'3');
        $expired4 = getStr1('"expiry_date":"','"',$cekvoucher,'4');
        $expired5 = getStr1('"expiry_date":"','"',$cekvoucher,'5');
        $expired6 = getStr1('"expiry_date":"','"',$cekvoucher,'6');
         setpin:
         echo "\n".color("nevy","?] Mau set pin?: y/n ");
         $pilih1 = trim(fgets(STDIN));
         if($pilih1 == "y" || $pilih1 == "Y"){
         //if($pilih1 == "y" && strpos($no, "628")){
         echo color("red","========( PIN ANDA = 366955 )========")."\n";
         $data2 = '{"pin":"366955"}';
         $getotpsetpin = request("/wallet/pin", $token, $data2, null, null, $uuid);
         echo "OTP SET PIN: ";
         $otpsetpin = trim(fgets(STDIN));
         $verifotpsetpin = request("/wallet/pin", $token, $data2, null, $otpsetpin, $uuid);
         echo $verifotpsetpin;
         }else if($pilih1 == "n" || $pilih1 == "N"){
         die();
         }else{
         echo color("red","-] GAGAL!!!\n");
         }
         }
         }
         }
         }else{
         goto setpin;
         }
         }else{
         echo color("red","-] Otp yang anda input salah");
         echo"\n==================================\n\n";
         echo color("yellow","!] Silahkan input kembali\n");
         goto otp;
         }
         }else{
         echo color("red","NOMOR SUDAH TERDAFTAR/SALAH !!!");
         echo "\nMau ulang? (y/n): ";
         $pilih = trim(fgets(STDIN));
         if($pilih == "y" || $pilih == "Y"){
         echo "\n==============REGISTER==============\n";
         goto ulang;
         }else{
         echo "\n==============REGISTER==============\n";
         goto ulang;
  }
 }
}
echo change()."\n"; ?>
