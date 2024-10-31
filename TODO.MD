add global user transfer details for withdrawal

email password recovery
email notifications for admin (registration, deposit, withdrawal)
email notifications for client (registration, deposit, withdrawal)


Cpanel details:
http://aonetrades.com/cpanel
username =  aonetrades
Password = Z~9wexk,4yya

29th OCTOBER
Aone Trades:
	Dashboard
		change some colors to match logo colors - DONE
		change font size of plans in website - DONE
		no KYC notification Needed - DONE
		Deposit and withdrawal history - DONE
		withdrawal request -> remove password/comments (update model and table) - DONE
		withdrawal request -> add transaction details there (update model and table) - DONE
		Personal details, Address details, bank info (into manage account) (update model and table) - DONE
		deposit section needs to change - DONE
		KYC ID/address (update model and table) - DONE
		Request for IB Partner -> (Click to became a IB partner) - DONE
	Admin
		Request for IB Partner - DONE
		KYC ID/address table implementation - DONE
		KYC system approve/reject needs to be done - DONE
	Global
		email notification to client and support email
		implementing 2 email systems (SMTP for notifications & resend.com for reset password)

Emails:-
    Password recovery
    Notifications:-
        User:-
            Welcome (1)
            Email Verification (1)
            For desposit (requested/approved/rejected) (3)
            For withdrawal (requested/approved/rejected) (3)
            Plan change (requested/approved/rejected) (3)
            KYC (requested/approved/rejected) (3)
            IB Partner (requested/approved/rejected) (3)
        Admin:-
            New Registration (1)
            For desposit requested (1)
            For withdrawal requested (1)
            Plan change requested (1)
            KYC requested (1)
            IB Partner requested (1)

Create single template with only dynamic content and user name
