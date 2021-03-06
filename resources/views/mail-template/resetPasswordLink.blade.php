<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta name="ROBOTS" content="NOINDEX, NOFOLLOW">
<title> {{env('APP_NAME')}}</title>
<style type="text/css">
#outlook a {padding:0;}
.ReadMsgBody { width: 100%; background-color: #DCDCDC; }
.ExternalClass { width:100%; background-color: #DCDCDC;}
.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;} 
html { width: 100%; }
body { -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; margin:0; padding:0;font-family: 'Sans-serif', arial;}
table { border-spacing: 0; table-layout: fixed; margin:0 auto; }
table table table { table-layout: auto;}
.yshortcuts a { border-bottom: none !important; }
a img {border:none;}
a {color:#0000ff; text-decoration:none;}
</style>
</head>
<body>
    <table width="600px" align="center" border="0" cellpadding="0" cellspacing="0" style="margin:0 auto; border:1px solid #cacaca;">
        <tr>
            <td valign="top" align="center" bgcolor="#634489">
                <a href="javascript:void(0)" style="color:#fff;padding:20px 0;display:inline-block;">
                    <img style="width:130px;" src="{{url('/')}}/public/web/assets/images/logo-icon.png">
                </a>
            </td>
        </tr>
        <tr>
            <td>
                <table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff" style="padding:0 20px">
                    <tr>
                        <td valign="top" style=" color: #383636;font-size: 20px;padding-top:30px;padding-bottom:5px;">Hi {{$data['name']}}</td>
                    </tr>
                    
                     <tr>
                        <td valign="top" style="color: #383636;font-size: 14px;padding-top:10px;padding-bottom:10px;">
                          Your temporary password : {{$data['tempory_code']}}
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" style="color: #383636;font-size: 14px;padding-top:10px;padding-bottom:10px;" title="Please click on the below link to reset your password.">
                            Please click on the below link to reset your password.
                        </td>
                    </tr>
                     <tr>
                        <td valign="top" style="color: #383636;font-size: 14px;padding-top:10px;padding-bottom:10px;" title="Please click on the below link to reset your password.">
                            <a href="{{$data['url']}}">Click Here</a>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" style="color: #383636;font-size: 13px;font-weight:bold;" title="Warm Regards,">
                            Warm Regards,
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" style="color: #383636;font-size: 13px;font-weight:bold;padding-bottom:30px;" title="ActivityApp">
                          {{env('APP_NAME')}}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#634489">
                    <tr>
                        <td valign="top" height="10"></td>
                    </tr>
                    <tr>
                        <td valign="top" style="text-align:center;font-size:13px;color:#fff;" title="@ Copyright 2018">
                            @ Copyright 2018
                        </td>
                    </tr>
                   
                    <tr>
                        <td valign="top" height="10"></td>
                    </tr>
                </table>
            </td>
        </tr>
       
    </table>
</body>
</html>