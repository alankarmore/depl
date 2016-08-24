<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>DEPL Pvt. Ltd.</title>
</head>

<body bgcolor="#8d8e90">
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#8d8e90">
    <tr>
        <td>
            <table width="600" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" align="center">
                <tr>
                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td colspan="3" height="10">&nbsp;</td>
                            </tr>
                            <tr>
                                <td width="61">&nbsp;</td>
                                <td width="144"><a href= "{{route('/')}}" target="_blank"><img src="{{asset('uploads/logo.png')}}" border="0" alt="DEPL Pvt. Ltd."/></a></td>
                                <td width="393">&nbsp;</td>
                            </tr>
                        </table></td>
                </tr>
                <tr>
                    <td height="10">&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="7%">&nbsp;</td>
                                <td width="58%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td width="95%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                    <td height="35" align="left" valign="middle" style="border-bottom:2px dotted #000000">
                                                                        <font style="font-family: Georgia, 'Times New Roman', Times, serif; color:#000000; font-size:15px">
                                                                            <strong>
                                                                                </p>
                                                                                <em><b>{{ucwords($inquiry->first_name." ".$inquiry->last_name)}}</b> has trying to reach with us by filling contact us form. He has posted following information</em>
                                                                            </strong>
                                                                        </font>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td height="15">&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left" valign="top">
                                                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                            <tr>
                                                                                <td width="35%">
                                                                                    <font style="font-family: Verdana, Geneva, sans-serif; color:#000000; font-size:13px; line-height:21px">User Email :</font> </td>
                                                                                <td width="65%">
                                                                                    <font style="font-family:Verdana, Geneva, sans-serif; color:#05bcda; font-size:12px; line-height:20px">
                                                                                        <strong><em>{{$inquiry->email}}</em></strong>
                                                                                    </font>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                            <tr>
                                                                                <td height="5" style="border-bottom:2px solid #d0d1d3"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td height="10"></td>
                                                                            </tr>

                                                                        </table></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left" valign="top">
                                                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                            <tr>
                                                                                <td width="35%">
                                                                                    <font style="font-family: Verdana, Geneva, sans-serif; color:#000000; font-size:13px; line-height:21px">Subject :</font> </td>
                                                                                <td width="65%">
                                                                                    <font style="font-family:Verdana, Geneva, sans-serif; color:#05bcda; font-size:12px; line-height:20px; color:#086cb3;">
                                                                                        <strong><em>{{ucfirst($inquiry->subject)}}</em></strong>
                                                                                    </font></td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                            <tr>
                                                                                <td height="5" style="border-bottom:2px solid #d0d1d3"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td height="10"></td>
                                                                            </tr>

                                                                        </table></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left" valign="top">
                                                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                            <tr>
                                                                                <td width="35%">
                                                                                    <font style="font-family: Verdana, Geneva, sans-serif; color:#000000; font-size:13px; line-height:21px">Message :</font> </td>
                                                                                <td width="65%"><font style="font-family:Verdana, Geneva, sans-serif; color:#05bcda; font-size:12px; line-height:20px; color:#086cb3;"><strong><em>{{$inquiry->message}}</em></strong></font></td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                            <tr>
                                                                                <td height="5" style="border-bottom:2px solid #d0d1d3"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td height="30"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Thanks,</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td height="5"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>DEPL Pvt Ltd Team.</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td height="5"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><a href= "{{route("/")}}" style="color:#086cb3; text-decoration:none"><strong><em>DEPL Pvt. Ltd.</em></strong></a></td>
                                                                            </tr>
                                                                        </table></td>
                                                                </tr>
                                                            </table></td>
                                                        <td width="5%">&nbsp;</td>
                                                    </tr>
                                                </table></td>
                                        </tr>
                                    </table></td>

                            </tr>
                        </table></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
            </table></td>
    </tr>
</table>
</body>
</html>