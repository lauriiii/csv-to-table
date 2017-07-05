# Kirby CSV to HTML Table converter

Version 1.0

## Installation

### 1. Kirby CLI

If you are using the Kirby CLI, you can install this plugin by running the following commands in your shell:

```text
$ cd path/to/kirby
$ kirby plugin:install lauriiii/csv-to-table
```

### 2. Clone or download

- Clone or download this repository.
- Unzip the archive if needed and rename the folder to csv-to-table.

Make sure that the plugin folder structure looks like this:

```text
site/plugins/csv-to-table/
```

## Usage

```text
(table: filename.csv)
```

### Options

#### 1. Delimiter

The separator used in your CSV files.

Default: ;

```text
(table: filename.csv delimiter: ,)
```

#### 2. Length

Default: 0

```text
(table: filename.csv length: 9999)
```

#### 3. Class

```text
(table: filename.csv class: test)
```

#### 4. Thead

Wraps the first row of the table with thead.

Default: false

```text
(table: filename.csv thead: true)
```

### Config options

You can use the following settings on your config file to change the defaults.

```php
c::set('csvtotable.default.class', '');
c::set('csvtotable.default.delimiter', ';');
c::set('csvtotable.default.length', '0');
c::set('csvtotable.default.thead', false);
```

## License

http://www.opensource.org/licenses/mit-license.php

## Author

Lauri Liimatta
http://lauriliimatta.com