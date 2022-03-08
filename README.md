# dnsmasq with webapi

## Add a DNS record

```sh
curl http://localhost:8080/add?host=example.com&ip=192.168.10.5
```

## Remove a DNS record

```sh
curl http://localhost:8080/rm?host=example.com
```

## Lookup

```sh
nslookup example.com 127.0.0.1
```

## Todo

- Record types (not just A records)
- Access keys
