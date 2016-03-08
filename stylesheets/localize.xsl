<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE xsl:stylesheet SYSTEM "lang://common.dtd">
<xsl:stylesheet 
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:ns0="urn:tmp"
    xmlns:exsl="http://exslt.org/common"
	extension-element-prefixes="exsl"
	exclude-result-prefixes="ns0"
	version="1.0">

<xsl:output
    media-type="application/xhtml+xml"
    method="html"
    encoding="UTF-8"
    indent="yes"
    omit-xml-declaration="no"
    doctype-public="-//W3C//DTD XHTML 1.1//EN"
    doctype-system="http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd" />
		
	<xsl:strip-space elements="*"/>
	
	<xsl:template match="/">
	    <html lang="&lang;">
            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
                <title>&title;</title>
            </head>
            <body>
                <h1><xsl:text>&hello;</xsl:text></h1>
                <p>&veryVeryVeryLongEntity;</p>
                <p>&currentLocale; - &lang;</p>
                <h2>&locales;</h2>
                <p>
                    <a href="index.php?lang=en">EN</a>&#160;
                    <a href="index.php?lang=ru">RU</a>
                </p>
            </body>
        </html>
	</xsl:template>
	    
</xsl:stylesheet>