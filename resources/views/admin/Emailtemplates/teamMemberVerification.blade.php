@include('admin.Emailtemplates.header')

<h3 style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 18px; line-height: 2em; font-weight: normal; margin: 0 auto 10px; padding: 0;">

    Hello {{$name}},

</h3>

<p style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;">

    {{$messageDetail}}

    <br /><br />

    If you want to approve, clicking the following link: <br />
    <a href="{{$url}}" target="_blank">{{$url}}</a>

    <br /><br />

</p>

@include('admin.Emailtemplates.footer')
