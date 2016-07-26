# Address-the-Stars

what3words have divided the Earth's surface into 57 trillion 3m-by-3m squares, and assigned each with a unique 3-word identifier
(table.lamp.spoon, for example). 

I took some inspiration from their idea and added three-word identifiers to a stellar catalogue. Now 87,475 stars from the HYG Database 
(https://github.com/astronexus/HYG-Database) each have a three-word address. 

<h3>How I did it</h3>

<ul>
<li>I created a table of the most commonly used words in the American-English language (http://www.wordfrequency.info/intro.asp)</li>
<li>I created a table of homophones (http://www.singularis.ltd.uk/bifroest/misc/homophones-list.html) and a table of offensive words (http://www.cs.cmu.edu/~biglou/resources/)</li>
<li>I wrote the <b>cleanse_wordlist</b> script to remove all homophones and offensive words from the main words table, and applied other cleansing parameters 
to remove, for example, words with less than 4 or more than 7 characters </li>
<li>I wrote the <b>w3w</b> script to loop through the HYG Stellar Database, generate a unique three-word combination from the main words table
and add it to the star's row</li>
</ul>

what3words doesn't use a database of three-word combinations. Since they have 57 trillion of them, this would be extremely inefficient, 
and a hindrance to the end-user experience. They instead encode geographical coordinates into three-word combinations, using what I assume to be
some kind of mapping function, where each pair of lat-long coordinates corresponds to a unique three-word address. 

I, however, needed not 57 trillion combinations, but a mere ~87,000; and sadly, the mathematical artisty required to design 
the encoding algorithm eludes me.

So, this is by no means a scalable solution to expand what3words to space and address all the stars in the galaxy. Nor will it bring the 
convenience of commnicatability to the field of astronomy. RA and Dec provide information such as rising and setting times, so astronomers and
star gazers can plan observing windows - so it'd be superfluous from their perspective. There's also no need for a navigational solution for space, like there is here on Earth. At least not yet. 

But we do  have enough words to provide a unique three-word address to every star in the Local Group, so perhaps a post-human, inter-stellar travelling
species will carry what3words into the realm of celestial navigation in the very distant future.

As for me: this was a fun project - my third so far - and a great learning experience.
