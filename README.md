# Designer Bios

A WordPress plugin to display an extended profile for designers, with iconset previews and referrer links.

## Installation

1. Download the Designer Bios zip file and upload to your WordPress `./wp-content/plugins/` directory.
2. Navigate to your WordPress admin `WP Admin / Plugins / Designer Bios` and activate the plugin.
3. Set the Iconfinder Username and bio information at `WP Admin / Users / username`

## Usage 

The Designer Bios plugin allows you to place a shortcode anywhere on your site where shortcodes are allowed: Posts, 
Pages, Custom Post types, widgets, etc.

To add a Designer Bio simply add the shortcode in the following format:

`[designer_bio username=webalys count=4]`

The accepted attributes for the shortcode are explained below:

### username

* _accepts: any valid iconfinder username_
* _default: true_
* _required: yes_

_**Example**_ 

`[designer_bio username=webalys]`

This is the iconfinder username for the user. This username may or may not be the same as the WordPress username for 
the designer. In most cases we will probably want the usernames to be the same but it may not always be possible. 

A WordPress username is not required in order to display iconsets by a designer, but it is required in order 
to display bio information.

### bio

* _**accepts**: 1, 0, true, false, yes, or no_
* _**default**: true_
* _**required**: no_

_**Example**_ 

`[designer_bio username=webalys bio=0]`

This attribute accepts a boolean value and indicates whether or not to display the text bio information. 
The attribute is optional and defaults to `true`

### avatar

* _**accepts**: 1, 0, true, false, yes, or no_
* _**default**: true_
* _**required**: no_

_**Example**_ 

`[designer_bio username=webalys avatar=0]`

This attribute accepts a boolean value and indicates whether or not to display the user's avatar.
The attribute is optional and defaults to `true`

### count

Indicates the number of iconsets to display.

* _**accepts**: integer_
* _**default**: 3_
* _**required**: no_ 

_**Example**_ 

`[designer_bio username=webalys count=4]`

### wp_username

The Iconfinder Blog (WordPress) username for the designer. It may not always be possible for the designer to have 
the same username in WordPress as on the Iconfinder site. Ideally they will be the same but not always.

To be clear: the `username` attribute refers to the designer's username on iconfinder.com. The `wp_username` is the 
username the designer uses to log into the blog (if they are a blog post author).

* _**accepts**: a valid WordPress username_
* _**default**: none_
* _**required**: no_


_**Example**_ 

`[designer_bio username=webalys wp_username=vincent]`


