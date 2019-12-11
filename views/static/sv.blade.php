<div style="background-color: lime">
<h2>Sub-View</h2>
<p>Diese View haben Sie nicht aktiv in Ihrer PHP-Datei aufgerufen, sondern sie wurde durch die View <em>Fragment</em> geladen, siehe <a href="https://github.com/EFTEC/BladeOne#sub-views">Sub Views</a>.</p>
</div>

<p>Sub-Views eignen sich gut, um weitere Fragmente zu laden, die für den aktuellen Abschnitt benötigt werden (denken Sie an &gt;FORM&lt; Elemente).</p>
<h2>SQL Tipp</h2>
<p>Mit <code>SELECT Name FROM Zutaten ORDER BY RAND() LIMIT 1</code> können Sie eine zufällige Zutat auswählen (und letztlich in die Kreuztabelle zwischen Mahlzeiten und Zutaten einfügen lassen, wenn Sie mögen).</p>