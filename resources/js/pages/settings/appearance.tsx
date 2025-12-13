import { Head } from '@inertiajs/react';

import AppearanceTabs from '@/components/appearance-tabs';
import HeadingSmall from '@/components/heading-small';
import { type BreadcrumbItem } from '@/types';

import AppLayout from '@/layouts/app-layout';
import SettingsLayout from '@/layouts/settings/layout';
import { edit as editAppearance } from '@/routes/appearance';

import { useLaravelReactI18n } from 'laravel-react-internationalization';

const breadcrumbs: BreadcrumbItem[] = [
  {
    title: 'Appearance settings',
    href: editAppearance().url,
  },
];

export default function Appearance() {
  const { t } = useLaravelReactI18n();
  return (
    <AppLayout breadcrumbs={breadcrumbs}>
      <Head title={t('Appearance settings')} />

      <SettingsLayout>
        <div className="space-y-6">
          <HeadingSmall
            title={t('Appearance settings')}
            description={t("Update your account's appearance settings")}
          />
          <AppearanceTabs />
        </div>
      </SettingsLayout>
    </AppLayout>
  );
}
