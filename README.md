# dnsmasq with webapi

Imagine this being deployed at **mydnsserver.com**

## Add an A record

```sh
curl http://mydnsserver.com:8080/add?record=A&domain=example.com&data=192.168.10.5
```

## Add an MX record

```sh
curl http://mydnsserver.com:8080/add?record=MX&domain=example.com&data=some.mailserver.com&priority=10
```

## Add a TXT record

```sh
curl http://mydnsserver.com:8080/add?record=TXT&domain=example.com&data=foo
```

## Forward a lookup to a different server

Example: forwarding facebook.com lookups to google's DNS with a pseudo-record called "FORWARD"

```sh
curl http://mydnsserver.com:8080/add?record=FORWARD&domain=facebook.com&data=8.8.8.8
```

mydnsserver.com will now be able to respond to facebook.com lookups

## Lookup

```sh
dig A example.com @mydnsserver.com
```

```sh
dig MX example.com @mydnsserver.com
```

```sh
dig TXT example.com @mydnsserver.com
```

## Todo

- Access keys
- A shitton of refactoring
- Being able to delete records
