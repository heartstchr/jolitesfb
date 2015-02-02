<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
@if (isset($website_description) and $website_description != "")
<meta name="description" content="{{{ $website_description }}}">
@else
<meta name="description" content="Jolites Social Network">
@endif
@if (isset($website_keywords) and $website_keywords != "")
<meta name="keywords" content="{{{ $website_keywords }}}">
@else
<meta name="keywords" content="social network, jolites, jgec">
@endif