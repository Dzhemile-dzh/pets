<?xml version="1.0" encoding="ISO-8859-1"?>
<xsl:stylesheet version="1.0"
                xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
                xmlns:media="http://search.yahoo.com/mrss/"
>

    <xsl:template match="/">
        <html>
            <head>
                <link href="/horses/css/rss.css" rel="stylesheet" type="text/css" />
                <style type="text/css">
                    body {
                    font-size:0.83em;
                    }
                </style>
            </head>
            <body>

                <h1 style="margin:20px 10px;height:50px;width:100%;clear:both;">

                    <xsl:element name="a">
                        <xsl:attribute name="href">
                            <xsl:value-of select="channel/link" />
                        </xsl:attribute>
                        <xsl:attribute name="style">
                            display:inline;
                            line-height:50px;
                            border:0;
                            float:left;

                        </xsl:attribute>

                        <xsl:value-of select="channel/title" />

                    </xsl:element>

                    <xsl:element name="a">
                        <xsl:attribute name="href">
                            <xsl:value-of select="/rss/channel/image/link" />
                        </xsl:attribute>
                        <xsl:attribute name="style">
                            position:relative;
                            margin: 0 0 0 15px;
                            float:left;
                        </xsl:attribute>
                        <xsl:element name="img">
                            <xsl:attribute name="src">
                                <xsl:value-of select="/rss/channel/image/url"/>
                            </xsl:attribute>
                            <xsl:attribute name="style">
                                border:0;
                            </xsl:attribute>
                        </xsl:element>
                    </xsl:element>

                </h1>
                <p style="clear:both;margin 10px;"> </p>
                <div class="top" style="margin:5px 0;padding: 2px;">
                    <h2>What is this page?</h2>
                    <p>
                        This is an RSS feed from the <a href="http://www.racingpost.com/">Racing Post website</a>.
                        RSS feeds allow you to stay up to date with the latest news and features you want from
                        Racing Post.
                    </p>
                    <p>
                        To subscribe to it, you will need a News Reader.
                        <xsl:element name="a">
                            <xsl:attribute name="href">
                                <xsl:value-of select="/rss/channel/image/link" />
                            </xsl:attribute>
                            Read more about our RSS feeds
                        </xsl:element>
                    </p>

                </div>
                <div>
                    <div class="titleWithLine">
                        <xsl:value-of select="/rss/channel/description" />
                    </div>
                    <xsl:for-each select="/rss/channel/item">
                        <div class="wrap clearfix">
                            <div class="image">
                                <xsl:element name="a">
                                    <xsl:attribute name="href">
                                        <xsl:value-of select="link"/>
                                    </xsl:attribute>
                                    <xsl:attribute name="style">
                                        font-size:1.2em;
                                    </xsl:attribute>
                                    <xsl:if test="media:thumbnail/@url">
                                        <img class="thumb">
                                            <xsl:attribute name="src">
                                                <xsl:value-of select="media:thumbnail/@url" />
                                            </xsl:attribute>
                                            <xsl:attribute name="width">
                                                <xsl:value-of select="media:thumbnail/@width" />
                                            </xsl:attribute>
                                            <xsl:attribute name="height">
                                                <xsl:value-of select="media:thumbnail/@height" />
                                            </xsl:attribute>
                                        </img>
                                    </xsl:if>
                                </xsl:element>
                            </div>
                            <div class="cont">
                                <xsl:element name="a">
                                    <xsl:attribute name="href">
                                        <xsl:value-of select="link"/>
                                    </xsl:attribute>
                                    <xsl:attribute name="style">
                                        font-size:1.2em;
                                    </xsl:attribute>
                                    <xsl:value-of select="title"/>
                                </xsl:element>
                                <p class="description">
                                    <xsl:value-of disable-output-escaping="yes" select="description" />
                                </p>
                                <p class="pubDate">
                                    <xsl:value-of select="pubDate" />
                                </p>
                            </div>
                        </div>
                    </xsl:for-each>
                </div>
                <div id="footer">
                    <xsl:value-of select="channel/copyright" />
                </div>
            </body>
        </html>
    </xsl:template>

</xsl:stylesheet>

