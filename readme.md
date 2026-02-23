# Kirby CSV to HTML Table converter

## Requirements

- Kirby 5
- PHP 8.1+

## Installation

### 1. Composer
```bash
composer require lauriiii/csv-to-table
```

### 2. Manual

- Clone or download this repository.
- Unzip the archive if needed and rename the folder to `csv-to-table`.

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

The separator used in your CSV file. Must be a single character.

Default: `;`
```text
(table: filename.csv delimiter: ,)
```

#### 2. Length

The maximum line length when reading the CSV file. Set to `0` for no limit.

Default: `0`
```text
(table: filename.csv length: 9999)
```

#### 3. Class

Adds a CSS class to the table element.
```text
(table: filename.csv class: my-table)
```

#### 4. Thead

Wraps the first row of the table in a `<thead>` element.

Default: `false`
```text
(table: filename.csv thead: true)
```

#### 5. Offset

Skips the given number of rows from the top before rendering. When `thead` is enabled, the offset is counted from the first data row, not the header row.

Default: `0`
```text
(table: filename.csv offset: 2)
```

### Config options

You can use the following settings in your `config.php` to change the defaults.
```php
return [
    'lauriiii.csv-to-table.class'     => '',
    'lauriiii.csv-to-table.delimiter' => ';',
    'lauriiii.csv-to-table.length'    => 0,
    'lauriiii.csv-to-table.thead'     => false,
    'lauriiii.csv-to-table.offset'    => 0,
];
```

## License

<http://www.opensource.org/licenses/mit-license.php>

## Author

Lauri Liimatta  
<https://lauriliimatta.com/en>