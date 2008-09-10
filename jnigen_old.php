<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title>Generating the SWT JNI Code for SWT 3.4</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Content-Style-Type" content="text/css">
    <link rel="stylesheet" href="http://dev.eclipse.org/default_style.css" type="text/css">
    <link rel="stylesheet" href="swt.css" type="text/css">
    <link rel="shortcut icon" href="http://www.eclipse.org/images/eclipse.ico" type="image/x-icon">
</head>
<body bgcolor="#ffffff" text="#000000">
<table width="875px" class="swtpage">
<colgroup><col width="125px"><col width="750px"></colgroup>
<tr><?php include "sidebar.php"; ?>
<td valign="top" style="padding: 10px"><h1 style="padding: 0; margin: 0; border-bottom: 1px solid #000000;">Generating the SWT JNI Code for SWT 3.4</h1>

<p>All of the C code used by SWT is generated by the <b>JNIGeneratorApp</b>
application from the <i>org.eclipse.swt.tools</i> project in Eclipse CVS.
This page describes how to use this tool when fixing bugs or adding
features to SWT.</p>

<h3>Adding native methods</h3>

<ol>
<li>Add the function prototype in <tt>OS.java</tt>, copying the style and structure
    of the other functions in that file.
    <p></p>
<li>Run <b>JNIGeneratorAppUI</b> from <i>org.eclipse.swt.tools</i>.  This
    is a GUI application for editing the metadata and a front end to the
    generation phase.  Select the appropriate class in the list and then
    find the method you added in <tt>OS.java</tt>.
    <p></p>
    <center><img src="images/jnigen.png" alt="JNIGeneratorAppUI"></center>
    <p></p>
<li>Set any flags and modify the casts for any primitive types.
    <p></p>
<li>Hit <i>Generate All</i> to generate the C code and metadata files.
    <p></p>
<li>Refresh the <i>org.eclipse.swt</i> project to tell Eclipse about the C
    changes, and refresh the <i>org.eclipse.swt.tools</i> project to see the
    metadata changes.
    <p></p>
<li>Compile the new C code and copy the new libraries to the appropriate
    fragment.  To compile the code, right-click on the <tt>build.xml</tt> file in the
    <tt>Eclipse SWT PI/ws/library</tt> directory for your window system, and choose
	"Run As -> Ant Build...". Select the JRE tab, and check "Run in the same JRE as the workspace".
    Select the Refresh tab, and check "Refresh resources upon completion" to refresh your workspace
    after running the build to ensure Eclipse picks up the fresh binaries. Now select the "Run" button.
    <p></p>
    <center><img src="images/buildxml.png" alt="build.xml"></center>
    <p></p>
</ol>

<h3>Adding structs</h3>

<p>Often, methods return values or require parameters as a C struct.  To
add a new structure, simply add a new class in the same package as
the OS.java file which matches the definition of the C structure.
This will be picked up and correctly handled by <i>JNIGeneratorApp</i>.</p>

<p>If a struct is input-only or output-only, this information can be used
by <i>JNIGeneratorApp</i> to generate more efficient C code.  Use the
<b>flags</b> attribute of the native function to indicate this in the
metadata.</p>

<h3>More Hints</h3>

<ul>
<li>For GTK+ and Motif, all native functions must be wrapped in locking
    code.  When adding functions, simply copy the style and structure of the
    other native functions.
<li>Many functions on Mac OS X return structs which use <b>unions</b>.  For
    an example of how to add the markup for a union, see the
    <b>ControlFontStyleRec</b> structure and its metadata.
</ul>

<p>And there you go!  If you're having trouble, please post to the SWT
mailing list or file a new bug in bugzilla.</p>

</table>
</body>
</html>