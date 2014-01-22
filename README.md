HTML Builder framework
==================

Problems
------------------
Usually initial HTML/CSS is built separately from CMS and during or after
backend development refinements have to be done. Changes might get lost
between two repositories (html / dev) and more you change, more likely
you are going to get lost.
<br/>

Websites are made of more or less reusable blocks. Changes in, for example,
footer usually have to reflect in all pages, which becomes a unnecessarily
time consuming task if you have lots of files to deal with.
<br/>

In CMS you usually do not have design overlay testing or CSS regression
testing
<br/>

Purpose
-------------------
The goal is to make a framework for building HTML templates surrounded (or
not) by any CMS. It should solve all problems mentioned above.
<br/>

TODO
-------------------
1. Grunt task which saves HTML to dist folder
2. Design overlay boilerplate
3. Grunt task for CSS regression testing with PhantomCSS