<VirtualHost *:80>
  ServerName {{ $domain }}.{{  config('services.apache.domain') }}
  Include "conf/{{ $domain }}.conf"
</VirtualHost>