Plugins for running SCOTXblog
=====================

The plugins here were written for the Supreme Court of Texas Blog (SCOTXblog).
If you are running a blog that also links to Texas court resources, you may find
this collection of plugins helpful.

### caseupdates-dev

This creates a set of shortcodes that call out to my docket database
and return with HTML snippets showing the status of the case.

* `[texapp {docket_no}]` - Renders HTML showing the current case status, with
links to any opinions.

* `[summary {docket_no}` - Renders a larger version that includes the most
recent summary of the case, as entered into the docket database.

* `[texapptext {docket_no}]` - Renders just a hyperlink to the full case name
and docket number. Used for inline text. *Note: will only render once in a
given paragraph*

### bulk-resave-action

This adds a bulk action to the Posts screen that forces a re-save of the
selected posts, triggering the "save" callbacks.

## Older plugins, which adapted to previous changes to the SCOTX website

Some of these fire to API calls on my own docket server, which (among other
things) use my own database to remap the old-style FilingID to the newer URL
formats at the court, which are (like mine) built around a docket number.

### dallas-coa-remap

In July 2012, the Dallas Court of Appeals changed all of its urls from the
www.5thcoa.courts.state.tx.us domain to the 5th.txcourts.gov domain.  
They did not leave a 301 redirect in place.

This plugin handles remapping all the old URLs to the new URL format.

### legacy-filingid-remap

Some of the older posts on SCOTXblog linked directly to docket pages hosted on the
Supreme Court of Texas website rather than to the DocketDB pages.  This plugin
remaps all of these links to DocketDB.

This is a stopgap measure.  I do not know how long DocketDB will continue to be
public once the Court changes its internal webpages.  But this will, at the least,
prevent any dead links in the interim.

### tames-error-page

In early 2012, the Fourteenth Court of Appeals in Houston switched to the
new TAMES system --- and did so without leaving up the old docket pages, opinions,
or other pages.  There were no 301 redirects, and I do not have an automatic way
to convert the old URLs to the new locations.  Accordingly, this plugin maps
links pointing to these pages to a locally hosted explanation/error page instead.

If you are adapting this for your own use, you may wish to instead point this
plugin at the TAMES search page on the 14th Court's website, which would
give your reader a head start on finding the right information.

### tames-redirection

This plugin remaps the links for certain resources now hosted on the Texas Supreme
Court website to mirror copies that I host.  These resources are still available online
today (in advance of the TAMES rollout).  I do not know if they will continue to be
hosted at the same location in the future.  This plugin is designed to preserve the
integrity of the blog archives so that everything continues to work.

Three types of data are mapped to raw copies that I am hosting on Amazon on S3:
(1) HTML orders lists, (2) PDF opinions, and (3) PDF electronic briefs.

A fourth type of data is mapped to the page where it is displayed on DocketDB:
(4) HTML versions of Texas Supreme Court opinions.
