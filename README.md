# Mawan Quiz Password Changer

Mawan Quiz Password Changer (MMQPC) is also known as Mawan Quiz Password Rotator (Quparo). This plugin automatically updates all Quiz Passwords at set intervals, such as every 10 minutes, specifically for quizzes with a 6-digit numerical password. Exam supervisors can download the MMQPC app from Google Play to view the latest passwords.

> Do you need an alternative plugin that is compatible with Google Authenticator and doesn't require an internet connection? [Click here](https://www.mmqpc.mawan.net/2fa/) to get it.

## Requirements

- Moodle 4.0 or later
- PHP 7.4 or later
- Access to Moodle cron
- Quiz module enabled
- Android device for supervisors (to run the companion app)

## Installation

1. Download the plugin from [Moodle Plugins Directory](https://moodle.org/plugins/local_mawanquizpasswordchanger)
2. Login as an administrator and go to Site Administration → Plugins → Install plugins
3. Upload the ZIP file
4. Click "Install plugin from the ZIP file"
5. Follow the on-screen installation instructions
6. Go to Site Administration → Plugins → Local Plugins → Mawan Quiz Password Changer to configure the plugin

## Configuration

1. Navigate to Site Administration → Plugins → Local Plugins → Mawan Quiz Password Changer
2. Configure the following settings:
   - **Salt**: A string that "seasons" the token generation (must match the app configuration)
   - **Duration**: Password change interval in minutes (recommended: use factors of 60)
3. Save changes
4. Ensure Moodle cron is running properly (see Troubleshooting section)

## How MMQPC Works

1. The admin installs the MMQPC plugin.
2. The admin configures the settings in the following menu:
   * **Site Administration**
   * **Plugins**
   * **Local Plugins → Mawan Quiz Password Changer**

   Set the **Salt** and **Duration** values, then save the settings.
3. The quizzes are assigned a 6-digit numerical password, such as 111111 or 123456.
4. Exam supervisors install the **MMawan Quiz Password Changer** app, available on [Google Play](https://play.google.com/store/apps/details?id=appinventor.ai_mawan911.MMQPC).
5. When a quiz is active, the plugin automatically generates a new random 6-digit password at intervals set by the **Duration** parameter (e.g., every 10 minutes).
6. The exam supervisor checks the Mawan Quiz Password Changer app on their Android device. The screen will display the latest password. **No internet connection is required!** The token (password) is reliably displayed, even in closed rooms with poor internet signal.
7. The exam supervisor announces the password (token) displayed on their device, and students enter it on their devices.
8. Students begin the quiz.
9. If a student exits or is forced out of Mawan after the 11th minute, they cannot use the same password to re-enter because the plugin has already changed it. This mechanism is similar to the token system used in UNBK (Ujian Nasional Berbasis Komputer, which means Computer-Based National Examination in Indonesian).

## Required Permissions

The following capabilities are required to use this plugin:

- `local/mawanquizpasswordchanger:changepassword`: Allows users to change quiz passwords
  - Default: Granted to editing teachers and managers
  - Risk: Configuration risk
  - Context: Module level

## Troubleshooting

### Common Issues

1. **Passwords not changing automatically:**
   - Check if cron is running properly
   - Verify the Duration setting
   - Ensure the quiz has an initial password set

2. **App and Moodle showing different passwords:**
   - Verify the Salt value matches between app and Moodle
   - Check if the time is synchronized on both systems
   - Ensure the Duration settings match

3. **Permission Issues:**
   - Verify user has required capabilities
   - Check context levels are correct
   - Ensure role assignments are proper

### Cron Setup

The Moodle admin must either:
1. Configure Moodle's `cron.php` to run every minute:
   ```bash
   * * * * * /usr/bin/php /path/to/moodle/admin/cli/cron.php
   ```
2. Run it manually through the menu: Site administration → Server → Tasks → Scheduled Tasks → Send data to mawan.net server → Run now

## Standard Version Limitations

The standard version is free to use indefinitely but has the following limitations:

* You cannot change the **Salt**
* You cannot adjust the token/password interval (**Duration**)

## Support

- Bug Reports: [GitHub Issues](https://github.com/mawanorg/moodle-local_mawanquizpasswordchanger/issues)
- Documentation: [Moodle Docs](https://docs.moodle.org/en/Mawan_Quiz_Password_Changer)
- Community Support: [Moodle Forums](https://moodle.org/mod/forum/view.php?id=8191)

## License

This plugin is licensed under the [GNU GPL v3 or later](https://www.gnu.org/licenses/gpl-3.0.html).

## Credits

- Developer: Mawan Agus Nugroho <mawan911@yahoo.com>
- Thanks to the Moodle community for testing and feedback
