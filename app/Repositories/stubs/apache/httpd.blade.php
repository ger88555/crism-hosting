<VirtualHost *:80>
  ServerName {{ $domain }}.{{ config('app.url') }}.com
  Include "conf/{{ $domain }}.conf"
</VirtualHost>