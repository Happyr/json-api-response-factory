# Change Log

The change log describes what is "Added", "Removed", "Changed" or "Fixed" between each release.

## 0.7.0

### Added

- `ResourceModifierInterface` to modify the resource before converting to array.

## 0.6.0

### Added

- Copy `source.message` to `detail` in `ErrorWithViolation`. Next version will remove the `source.message`.

## 0.5.0

### Added

- Support for fractal 0.20.0

### Removed

- Support for PHP 7.2 and 7.3
- Support for Symfony 4

## 0.4.0

### Fixed

- Use late static binding on factories of Error

## 0.3.0

### Added

- Support for Symfony 6

### Changed

- Content-Type depends on the serializer used or the second parameter for `ResponseFactory`.
- Removed `final` keyword from models

### Removed

- Message::noContent()

## 0.2.0

### Added

- Support for Symfony 5

## 0.1.2

### Added

- `meta` can be passed to item/collection create
## 0.2.0

### Added

- Symfony 5 support
