    <?php include 'header.inc';?>
    <!--author information-->
    <meta name="author" content="Jade Veenstra">
    <!--title of page-->
    <title>LeafByte Tech </title>
</head>
<!-- body is declared as home so it is unique to this html page-->
<body class="home">
    <!-- navigation menu with hyperlinks to the about, apply, index and job pages, along with the e-mail contact-->
	<?php include 'nav.inc';?>
    <!--title is given a separate id-->
    <h1 id="leafbytetitle">LEAFBYTE TECH</h1>
    <!-- the company information is sectioned off-->
    <section id="indexcompanyinfo">
        <p id="companydescription">LeafByte Tech is an accredited job advertising platform focused on the technology industry. Here at LeafByte, we assist businesses in finding the right candidates and connect job seekers with the perfect opportunities through reliable postings, aiming to link skilled technology professionals with innovative companies in various sectors.</p> 
        <hr class="indexdivider1">
        <p>From software engineering roles to IT support positions, there are various listings on offer.</p>
        <p><a id="indexinfosearch" href="/project1/jobs.html"><strong>SEARCH NOW</strong></a></p>
        <hr class="indexdivider2">
    <!-- text written by Moji, implemented into Jade's code-->
        <p>If you are ready to make your mark within the tech world, join us today in our journey to transform the industry, one byte at a time.</p>
        <p><a id="indexinfoapply" href="/project1/apply.html"><strong>APPLY NOW</strong></a></p>
        <hr class="indexdivider3">
        <p id="emailink">Or contact us at <a href="mailto:info@LeafByteTech.com.au">info@LeafByteTech.com.au</a> for any inquiries.</p>
    </section>
    <!-- image of the company logo. logo was created on canva.com-->
    <img id="imagelogo" src="images/leafbytetechlogo.png" alt="CompanyLogo">
    <!-- line breaks so the footer doesnt cover text (dont know the problem?)-->
    <footer class="footer">
    <?php include 'footer.inc';?>
</body>
</html>