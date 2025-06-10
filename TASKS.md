# Improvement Tasks

This document tracks potential enhancements for the calendar application.

- [ ] **User Accounts and Authentication**
  - Implement Laravel authentication scaffolding.
  - Associate events and RSVPs with user accounts.

- [ ] **Email Notifications**
  - Send confirmation emails when events are created or RSVPs submitted.
  - Attach the generated `.ics` file to outgoing emails.

- [ ] **Event Recurrence**
  - Add recurrence rules to the events table.
  - Generate occurrences for recurring events.

- [ ] **Calendar Views**
  - Integrate a calendar widget for day, week and month views.
  - Enable drag-and-drop event interactions.

- [ ] **Search and Filters**
  - [x] Filter events by title or date range via the API.
  - [x] Provide search controls in the frontend.

- [ ] **Improved Validation and Error Messages**
  - Prevent overlapping events and duplicate RSVPs.
  - Display clearer validation errors to the user.

- [ ] **Attendance Management**
  - Allow attendees to update or delete RSVPs.

- [ ] **Admin Dashboard**
  - Display metrics such as total RSVPs and upcoming events.
  - Provide management screens for events and attendees.

- [ ] **ICS Import**
  - Support bulk event creation by uploading `.ics` files.

