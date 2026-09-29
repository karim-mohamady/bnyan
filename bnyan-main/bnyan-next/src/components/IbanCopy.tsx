'use client';

import React, { useCallback, useState } from 'react';
import Icon from '@/components/Icon';
import { CONTACT } from '@/data/contact';

type Variant = 'light' | 'dark' | 'card';

interface Props {
  variant?: Variant;
  className?: string;
  showBankName?: boolean;
  showAccountName?: boolean;
}

export default function IbanCopy({
  variant = 'card',
  className = '',
  showBankName = true,
  showAccountName = true,
}: Props) {
  const [copied, setCopied] = useState(false);

  const handleCopy = useCallback(async () => {
    try {
      await navigator.clipboard.writeText(CONTACT.bank.iban);
    } catch {
      const textarea = document.createElement('textarea');
      textarea.value = CONTACT.bank.iban;
      textarea.style.position = 'fixed';
      textarea.style.opacity = '0';
      document.body.appendChild(textarea);
      textarea.select();
      document.execCommand('copy');
      document.body.removeChild(textarea);
    }
    setCopied(true);
    window.setTimeout(() => setCopied(false), 2200);
  }, []);

  return (
    <div className={`iban-block iban-block--${variant} ${copied ? 'copied' : ''} ${className}`}>
      {showAccountName && (
        <div className="iban-block__name">{CONTACT.bank.accountName}</div>
      )}
      {showBankName && (
        <div className="iban-block__bank">آيبان الراجحي · {CONTACT.bank.name}</div>
      )}
      <button
        type="button"
        className="iban-block__btn"
        onClick={handleCopy}
        aria-label={copied ? 'تم نسخ الآيبان' : 'نسخ رقم الآيبان'}
      >
        <div className="iban-block__meta">
          <span className="iban-block__label">رقم الحساب (IBAN)</span>
          <span className="iban-block__value" dir="ltr" translate="no">
            {CONTACT.bank.ibanDisplay}
          </span>
        </div>
        <span className="iban-block__copy">
          <Icon name={copied ? 'check' : 'file'} width={16} height={16} />
          <small>{copied ? 'تم النسخ' : 'نسخ'}</small>
        </span>
      </button>
    </div>
  );
}
