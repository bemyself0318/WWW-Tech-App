<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:template match="/">

<html> 
<head>
<style>
	table, th, td {
    border: 1px solid black;
	}
</style>
</head>
	<body>
		<xsl:for-each select="mixedteams/baseball">
		  <table style="margin:0px auto;width=1100;text-align:center">
				<xsl:attribute name="bgcolor">
					<xsl:value-of select="BColor"/>
				</xsl:attribute>
				<font>
				<xsl:attribute name="color">
					<xsl:value-of select="Color"/>
				</xsl:attribute>
				<tr>
				<td colspan="5"><xsl:value-of select="Team"/></td>
				</tr>
				<tr>
					<td style="text-align:center">Image</td>
					<td style="text-align:center" colspan="2">star</td>
					<td style="text-align:center" >Coach</td>
					<td style="text-align:center" >League</td>
				</tr>
				<tr>
					<td>
						<img width="100">
							<xsl:attribute name="src">
								<xsl:value-of select="Image"/>
							</xsl:attribute>
						</img>
					</td>
					<td><xsl:value-of select="name"/></td>
					<td><xsl:value-of select="birth"/></td>
					<td><xsl:value-of select="Coach"/></td>
					<td><xsl:value-of select="League"/></td>
				</tr>
				<tr>
					<td colspan="5">
						<iframe  width="1080" height="720" >
							<xsl:attribute name="src">
								<xsl:value-of select="Video"/>
							</xsl:attribute>
						</iframe>
					</td>
				</tr>
				</font>
		  </table>
		</xsl:for-each>
	</body>
</html>
</xsl:template>
</xsl:stylesheet>

