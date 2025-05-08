<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Position Descriptions page">
    <meta name="keywords" content="HTML, Doctype, Head, Body, Meta, Paragraph, Headings, Strong, Emphasis">
    <meta name="author" content="Muhammad Taki">
    <link rel="stylesheet" href="styles/styles.css">
    <title>Job description</title>
</head>
<body class="page" id="test_jobs">
    <!--Applied <nav> to create a navigation section for site links-->
    <?php include 'nav.inc';?>
    <!--Applied <img> to display the company logo-->
    <img id="logo_jobs" src="images/leafbytetechlogo.png" alt="CompanyLogo"> 
    <h1 id="h1_jobs">Jobs at Leaf Byte Tech</h1>
        <!--Applied <aside> to show additional information like employee benefits-->
    <aside id="aside_jobs">
        <h3>Benefits of working at </h3>
        <ul>
            <!--Use of GenAI (Gemini), -->
            <li><b>Flexible Work Hours</b> – We believe in results, not rigid schedules.</li>
            <li><b>Remote & Hybrid Options</b> – Work from anywhere</li>
            <li><b>Learning & Development</b> – Access to online courses, and certifications</li>
            <li><b>Tech Perks</b> – Get high tech laptop and access to paid softwares fore free </li>
        </ul>
    </aside>
     <!--Applied <section> to organise related job listing content-->
    <section>
        <fieldset>
             <!--Applied <legend> to give the fieldset a title-->
            <legend class="h1_jobs"><h2>Software Developer</h2></legend>
            <p><b>Reference Number:</b> SF71T</p>
            <p><b>Description:</b></p>
            <!--Use of GenAI (Gemini),
            Prompt: "make me a job description for Software development at "Leaf Byte Tech". make it in a paragraph and short"-->
            <p>
                Leaf Byte Tech is seeking a talented Software Developer to contribute to our innovative projects. The ideal candidate will possess strong problem-solving skills, proficiency in relevant programming languages, and a passion for creating efficient and scalable software solutions. Responsibilities include designing, developing, and testing applications, collaborating with cross-functional teams, and maintaining code quality. We value a proactive approach, a commitment to continuous learning, and the ability to thrive in a fast-paced, collaborative environment.
            </p>
            <p><b>Responsibilites of this position include:</b></p>
            <ol>
                <!--Use of GenAI (Gemini)
                Prompt: "write me responsibilities for ai/ml engineer, in bullet"-->
                <li> Design, develop, and maintain web and mobile applications.</li>
                <li>Write clean, scalable, and well-documented code.</li>
                <li>Participate in code reviews and agile sprint planning.</li>
                <li>Identify, troubleshoot, and fix bugs or performance issues.</li>
            </ol>
            <p><b>Salary Range:</b> $100k - $135k</p>
        </fieldset>
    </section>
    <br>
    <section>
        <fieldset>
            <legend class="h1_jobs"><h2>AI/ML Engineer</h2></legend>
            <p><b>Reference Number:</b> AI02M</p>
            <p><b>Description:</b></p>
            <!--Use of GenAI (Gemini)
            Prompt: "make me a job description for AI/ML Engineer at "Leaf Byte Tech". make it in a paragraph and short"-->
            <p>Leaf Byte Tech is seeking a skilled AI/ML Engineer to develop and deploy cutting-edge machine learning models. The ideal candidate will have expertise in designing and implementing algorithms, working with large datasets, and utilizing frameworks like TensorFlow or PyTorch. Responsibilities include building and optimizing AI solutions, collaborating with cross-functional teams, and staying up-to-date with the latest advancements in the field. We're looking for someone passionate about creating intelligent systems and driving innovation through AI.</p>
            <p> <b>Responsibilites of this position include:</b></p>
            <ol>
                <!--Use of GenAI (Gemini)
                Prompt: "write me responsibilities for soft dev, in bullet"-->
                <li>Build, train, and deploy machine learning models for real-world applications</li>
                <li>Research and implement state-of-the-art ML/AI techniques.</li>
                <li>Collaborate with software engineers and data scientists to integrate models into production.</li>
                <li>Maintain and monitor deployed models to ensure long-term efficiency and relevance.</li>
            </ol>
            <p><b>Salary Range:</b> $125k - $150k</p>
        </fieldset>
        <br>
        <br>
        <br>
    </section>
    <!--Applied <footer> to include closing site content such as credits and links-->
    <?php include 'footer.inc';?>
</body>
</html>