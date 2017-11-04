# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

## [Unreleased]

## 0.0.1 - 2017-11-03
### Added
- New Engine for checking routes with parameters, now has a two-step check.
- Total re-design of the service class App\Container\ServiceContainer for dependency injections.
- Symfony components available for use.
- Total reform in class App\Http\RouterKhanReq.
- Total reform in class App\Http\RouterKhanRes.
- Created interfaces to Request and Response.
- Extended Symfony HttpFoundation for classes App\Http\RouterKhanReq and App\Http\RouterKhanRes.

## 0.0.1 - 2017-11-01
### Added
- Login system to show system operation.
- Multiple routes on a single call.
- Pick up all incoming requisitions.
- Default file for error.

## 0.0.1 - 2017-10-29
### Added
- Config file ( config/config.json ).
- Now with support for Classes, Arrays and Functions routes.
- Added middleware to enhance development.
- Project now supports mode (Model, view, Controller).

### Update
- Estruture project.
- Changes in route callback execution.

### Remove
- Remove native function Container and Database.

## 0.0.1 - 2017-10-28
### Added
- This CHANGELOG file to hopefully serve as an evolving example of a
  standardized open source project CHANGELOG.
- New libraries were added to help with development. Examples (Medoo, Upload OO).
- README now contains answers to common questions about CHANGELOGS.
- Good examples and basic guidelines, including proper date formatting.