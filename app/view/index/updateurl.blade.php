@extends('index.layout')
@section('content')
    <div class="items">
        <div class="item item-0">
            @include('index.mune')
            <h2>网址信息修改</h2><div class="page_content">
                <p>	<span style="color:#4C33E5;"><b>每个网站对应一个唯一的管理员邮箱，请使用管理员邮箱进行修改！</b></span></p>
                <p>	<span style="color:#0cd7e2;"><b>本站对外邮箱：{{ $system['email'] }}，邮箱使用范围：广告合作，主动获取最新网址!</b></span></p>
                <hr />
                <div class="input">
                    <div>管理员邮箱：<input type="email" name="email" id="email" placeholder="请输入管理员邮箱" class="signinput"></div>
                    <div>
                        <button style="width: 150px;line-height: 33px;background-color: #61b3e6;border: none;color: #fff;margin-top: 20px;margin-left: 70px;" id="signbtn">提交</button>
                    </div>
                </div>
                <div class="webinfo" style="display: none">
                    <div>网站名称：<input type="text" name="name" id="name" placeholder="请输入网站名称" class="signinput" style="margin-bottom: 10px;"></div>
                    <div>网站地址：<input type="text" name="url" id="url" placeholder="请输入网址" class="signinput" style="margin-bottom: 10px;"></div>
                    <div>管理邮箱：<input type="email" name="email" id="upemail" placeholder="请输入管理邮箱" class="signinput">*用于自助修改网站信息</div>
                    <div>
                        网站分类:
                        <div id="parent">
                            <select name="sort" id="sort">
                                @foreach($sort as $value)
                                    <option value="{{ $value->id }}">{{ $value->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div>
                        <button style="width: 150px;line-height: 33px;background-color: #61b3e6;border: none;color: #fff;margin-top: 20px;margin-left: 70px;" id="uptadebtn">提交</button>
                    </div>
                </div>
            </div>
        </div>
        @endsection
        @section('script')
            <script type="application/javascript">
                $(function(){

                    isData = false;

                    $('#signbtn').click(function(){

                        var email = $("#email").val();

                        if (email == '') {
                            alertWind('邮箱不能为空');
                            return false;
                        }
                        if (!checkemail(email)) {
                            alertWind('请输入正确的邮箱');
                            return false;
                        }
                        $.post("/Api/isEmailUrl", { email:email},function(data){
                            if (data.status == 'success') {
                                $(".input").hide();
                                $("#name").val(data.data.name);
                                $("#url").val(data.data.url);
                                $("#upemail").val(data.data.email);
                                $("#sort").val(data.data.sort);
                                $(".webinfo").show();
                                isData = true;
                            }else{
                                alertWind(data.msg);
                            }
                        });

                    });

                   $("#uptadebtn").click(function(){

                       var name = $("#name").val();
                       var url = $("#url").val();
                       var email = $("#upemail").val();
                       var sort = $("#sort").val();
                       if (name == '') {
                           alertWind('网站名称不能为空');
                           return false;
                       }
                       if (url == '') {
                           alertWind('网站链接不能为空');
                           return false;
                       }
                       if (email == '') {
                           alertWind('管理邮箱不能为空');
                           return false;
                       }
                       if (!checkUrl(url)) {
                           alertWind('请输入正确的域名，如：http://xxx.com,http://www.xxx.com');
                           return false;
                       }
                       if (!checkemail(email)) {
                           alertWind('请输入正确的邮箱');
                           return false;
                       }
                       $.post("/Api/updateUrl", { name:name,url:url,email:email,sort:sort},function(data){
                           if (data.status == 'success') {
                               $(".webinfo").hide();
                               $(".input").show();
                               $("#email").val('');
                               alertWind(data.msg);
                           }else{
                               if (data.code == 404) {
                                   $(".webinfo").hide();
                                   $(".input").show();
                                   $("#email").val('');
                               }
                               alertWind(data.msg);
                           }
                       });
                   });

                    function checkemail(email)
                    {
                        var reg = new RegExp("^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$");
                        if (!reg.test(email)) {
                            return false;
                        }else{
                            return true;
                        }
                    }
                    function checkUrl(url)
                    {
                        var reg = '^(http|https)\\://([a-zA-Z0-9\\.\\-]+(\\:[a-zA-Z0-9\\.&%\\$\\-]+)*@)?((25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[1-9])\\.(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[1-9]|0)\\.(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[1-9]|0)\\.(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[0-9])|([a-zA-Z0-9\\-]+\\.)*[a-zA-Z0-9\\-]+\\.[a-zA-Z]{2,4})(\\:[0-9]+)?(/[^/][a-zA-Z0-9\\.\\,\\?\\\'\\\\/\\+&%\\$#\\=~_\\-@]*)*$';
                        var objExp=new RegExp(reg);
                        if (objExp.test(url)) {
                            return true;
                        }else{
                            return false;
                        }
                    }
                })
            </script>
@endsection