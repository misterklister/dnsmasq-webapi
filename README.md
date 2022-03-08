# dnsmasq with webapi

Imagine this being deployed at **mydnsserver.com**

## Add a DNS record

```sh
curl http://mydnsserver.com:8080/add?host=example.com&ip=192.168.10.5
```

## Remove a DNS record

```sh
curl http://mydnsserver.com:8080/rm?host=example.com
```

## Lookup

```sh
dig A example.com @mydnsserver.com
```

## Todo

- Record types (not just A records)
- Access keys
- A shitton of refactoring
