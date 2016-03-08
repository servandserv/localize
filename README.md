# localize

Локализация через ENTITIES при использовании XSLT шаблонов

1. В шаблонах прописываем DOCTYPE  ссылающийся на DTD файлы с ENTITIES

<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE xsl:stylesheet SYSTEM "lang://common.dtd">
<xsl:stylesheet 
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    ....
    
2. В ссылке на DTD файл используем свой протокол lang://
который затем реализуем через STREAM WRAPPER 

3. В STREAM WRAPPER определяем локаль клиента по умолчанию 
или используем явно указанной клиентом.
Полученную локаль используем для указания конечного пути файла DTD
содержащего ENTITIES

[Элементарный пример](https://www.servandserv.com/localize)